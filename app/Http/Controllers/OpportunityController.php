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
            // OPP Validations
            $this->opportunityService->validateCloseOpp( $validatedData['status'] );
            $this->opportunityService->validateActualCloseDate( $validatedData['status'], $validatedData['actual_close_date'] );
            $this->opportunityService->validateSuccessProbability( $validatedData['stage_id'], $validatedData['success_probability'] );
            // OPP Calculations
            $validatedData['weighted_value'] = $this->opportunityService->calculateWeightedValue(
                $validatedData['estimated_value'] ?? 0,
                $validatedData['success_probability']
            );

            $this->opportunityRepository->create($validatedData);
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
        //
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

            // OPP Validations
            $this->opportunityService->validateCloseOpp( $validatedData['status'] );
            $this->opportunityService->validateActualCloseDate( $validatedData['status'], $validatedData['actual_close_date'] );
            $this->opportunityService->validateSuccessProbability( $validatedData['stage_id'], $validatedData['success_probability'] );
            // OPP Calculations
            $validatedData['weighted_value'] = $this->opportunityService->calculateWeightedValue(
                $validatedData['estimated_value'] ?? 0,
                $validatedData['success_probability']
            );

            $this->opportunityRepository->update($opportunity, $validatedData);
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
        //
    }

    public function close(Request $request, string $id) {
        //
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
