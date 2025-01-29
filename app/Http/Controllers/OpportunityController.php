<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Repositories\OpportunityRepository;
use App\Services\OpportunityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OpportunityController extends Controller {

    protected $opportunityRepository;
    protected $opportunityService;
    protected $clientRepository;

    public function __construct(
        OpportunityRepository $opportunityRepository, ClientRepository $clientRepository, OpportunityService $opportunityService
    ) {
        $this->opportunityRepository = $opportunityRepository;
        $this->clientRepository = $clientRepository;
        $this->opportunityService = $opportunityService;
    }
    
    public function index(Request $request) {
        $ownerId = $request->get('owner');
        $listStatus = $this->opportunityRepository->listStatus();

        $opportunities = $ownerId 
            ? $this->opportunityRepository->allOwnerFiltered($ownerId) 
            : $this->opportunityRepository->all();

        return view( 'opportunity.index', compact('opportunities', 'listStatus') );
    }

    public function create() {
        return view( 'opportunity.form',
            [
                'owners' => \App\Models\User::listOwners(),
                'listStatus' => $this->opportunityRepository->listStatus(),
                'stages' => \App\Models\OpportunityStage::all(),
                'clients' => $this->clientRepository->all(),
            ]
        );
    }

    public function store(Request $request) {
        try {

            $validatedData = $this->validateRequestData($request);
            $validatedData['success_probability'] = $this->opportunityService->calculateSuccessProbability( $validatedData['stage_id'] );
            
            $formatedData = $this->opportunityService->prepareOpportunity($validatedData);

            $this->opportunityRepository->create($formatedData);
            return redirect()->route('opportunity.index')->with('success', 'Opportunity created.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in OpportunityController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in OpportunityController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating opportunity. Try again...')->withInput();
        }
    }

    public function show(string $id) {
        return view('opportunity.show', [
            'opportunity' => $this->opportunityRepository->find($id),
            'listStatus' => $this->opportunityRepository->listStatus(),
        ]);
    }

    public function edit(string $id) {
        return view( 'opportunity.form',
            [
                'owners' => \App\Models\User::listOwners(),
                'listStatus' => $this->opportunityRepository->listStatus(),
                'stages' => \App\Models\OpportunityStage::all(),
                'clients' => $this->clientRepository->all(),
                'opportunity' => $this->opportunityRepository->find($id),
            ]
        );
    }

    public function update(Request $request, string $id) {
        try {

            $validatedData = $this->validateRequestData($request);
            $validatedData['success_probability'] = $this->opportunityService->calculateSuccessProbability( $validatedData['stage_id'] );

            $opportunity = $this->opportunityRepository->find($id);
            if (!$opportunity) return redirect()->route('opportunity.index')->withErrors(['error' => 'Opportunity not found.']);

            $formatedData = $this->opportunityService->prepareOpportunity($validatedData);

            $this->opportunityRepository->update($opportunity, $formatedData);
            return redirect()->route('opportunity.index')->with('success', 'Opportunity updated.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in OpportunityController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in OpportunityController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating opportunity. Try again...')->withInput();
        }
    }

    public function destroy(string $id) {
        try {

            $opportunity = $this->opportunityRepository->find($id);
            if (!$opportunity) return redirect()->route('opportunity.index')->withErrors(['error' => 'Opportunity not found.']);

            $this->opportunityRepository->delete($opportunity);
            return redirect()->route('opportunity.index')->with('success', 'Opportunity deleted.');

        } catch (\Throwable $e) {
            Log::error('Error in OpportunityController::destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting opportunity. Try again...');
        }
    }

    public function close(Request $request, string $id) {
        try {

            $opportunity = $this->opportunityRepository->find($id);
            if (!$opportunity) return redirect()->route('opportunity.index')->withErrors(['error' => 'Opportunity not found.']);
            
            $validatedData = $request->validate([
                'closed_status' => [
                    'required', 'in:'. $this->opportunityRepository::STATUS_CLOSED_WON .','. $this->opportunityRepository::STATUS_CLOSED_LOST
                ],
            ], [ 'closed_status' => ['Only select Close Won or Close Lost'] ]);

            $opportunity = $this->opportunityService->prepareCloseOpportunity( $opportunity, $validatedData['closed_status'] );

            $opportunity->save();
            return redirect()->route('opportunity.index')->with('success', 'Opportunity closed.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in OpportunityController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in OpportunityController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error closing opportunity. Try again...')->withInput();
        }
    }

    protected function validateRequestData(Request $request) {
        return $request->validate([
            'name' => 'required|string|max:150',
            'owner_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:' . implode(',', array_keys($this->opportunityRepository->listStatus())),
            'stage_id' => 'required|exists:opportunity_stages,id',
            'source' => 'nullable|string|max:150',
            'created_date' => 'required|date',
            'estimated_close_date' => 'nullable|date|after_or_equal:created_date',
            'actual_close_date' => 'nullable|date|after_or_equal:created_date',
            'estimated_value' => 'required|numeric|min:0',
        ]);
    }

}
