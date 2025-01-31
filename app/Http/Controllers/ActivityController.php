<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ContactRepository;
use App\Repositories\OpportunityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller {

    protected $activityRepository;
    protected $clientRepository;
    protected $contactRepository;
    protected $opportunityRepository;

    public function __construct(
        ActivityRepository $activityRepository,
        ClientRepository $clientRepository,
        ContactRepository $contactRepository,
        OpportunityRepository $opportunityRepository
    ) {
        $this->activityRepository = $activityRepository;
        $this->clientRepository = $clientRepository;
        $this->contactRepository = $contactRepository;
        $this->opportunityRepository = $opportunityRepository;
    }
    
    public function index(Request $request) {
        $ownerId = $request->get('owner');

        $activities = $ownerId 
            ? $this->activityRepository->allOwnerFiltered($ownerId) 
            : $this->activityRepository->all();

        return view( 'activity.index', compact('activities') );
    }

    public function create() {
        return view( 'activity.form',
            [
                'owners' => \App\Models\User::listOwners(),
                'clients' => $this->clientRepository->all(),
                'contacts' => $this->contactRepository->all(),
                'oportunities' => $this->opportunityRepository->all(),
                'types' => $this->activityRepository->types(),
                'statuses' => $this->activityRepository->status(),
                'priorities' => $this->activityRepository->priority()
            ]
        );
    }

    public function store(Request $request) {
        try {

            $validateData = $this->validateRequestData($request);
            if ($validateData['status'] == 'completed') $validateData['completed'] = 1;

            $validateData = $this->activityRepository->create($validateData);
            return redirect()->route('activity.index')->with('success', 'Activity created.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in ActivityController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in ActivityController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating activity. Try again...')->withInput();
        }
    }

    public function show(string $id) {
        return view('activity.show', [
            'activity' => $this->activityRepository->find($id)
        ]);
    }

    public function edit(string $id) {
        return view( 'activity.form',
            [
                'owners' => \App\Models\User::listOwners(),
                'clients' => $this->clientRepository->all(),
                'contacts' => $this->contactRepository->all(),
                'oportunities' => $this->opportunityRepository->all(),
                'types' => $this->activityRepository->types(),
                'statuses' => $this->activityRepository->status(),
                'priorities' => $this->activityRepository->priority(),
                'activity' => $this->activityRepository->find($id),
            ]
        );
    }

    public function update(Request $request, string $id) {
        try {

            $validateData = $this->validateRequestData($request);
            if ($validateData['status'] == 'completed') $validateData['completed'] = 1;

            $activity = $this->activityRepository->find($id);
            if (!$activity) return redirect()->route('activity.index')->with(['error' => 'Activity not found.']);

            $this->activityRepository->update($activity, $validateData);
            return redirect()->route('activity.index')->with('success', 'Activity updated.');


        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in ActivityController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in ActivityController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating activity. Try again...')->withInput();
        }
    }

    public function destroy(string $id) {
        try {

            $activity = $this->activityRepository->find($id);
            if (!$activity) return redirect()->route('activity.index')->with(['error' => 'Activity not found.']);

            $this->activityRepository->delete($activity);
            return redirect()->route('activity.index')->with('success', 'Activity deleted.');

        } catch (\Throwable $e) {
            Log::error('Error in ActivityController::destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting activity. Try again...');
        }
    }

    public function completed(string $id) {
        try {

            $activity = $this->activityRepository->find($id);
            if (!$activity) return redirect()->back()->with(['error' => 'Activity not found.'])->withInput();

            if ($activity->status == 'completed' && $activity->completed == 1)
                return redirect()->route('activity.index')->with('info', 'Activity has been completed.');

            $this->activityRepository->update($activity, ['completed' => 1, 'status' => 'completed']);
            return redirect()->route('activity.index')->with('success', 'Activity completed.');

        } catch (\Throwable $e) {
            Log::error('Error in ActivityController::completed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting activity. Try again...');
        }
    }

    protected function validateRequestData(Request $request) {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'type_id' => ['required', 'exists:activity_types,id'],
            'status' => ['required', 'in:' . implode(',', $this->activityRepository->status() )],
            'priority' => ['required', 'in:' . implode(',', $this->activityRepository->priority() )],
            'owner_id' => ['required', 'exists:users,id'],
            'description' => ['required', 'string', 'max:150'],
            'scheduled_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:scheduled_date'],
            'follow_up_notes' => ['nullable', 'string', 'min:5', 'max:2000'],
            'client_id' => ['nullable', 'sometimes', 'exists:clients,id', 'required_without_all:contact_id,opportunity_id'],
            'contact_id' => ['nullable', 'sometimes', 'exists:contacts,id', 'required_without_all:client_id,opportunity_id'],
            'opportunity_id' => ['nullable', 'sometimes', 'exists:opportunities,id', 'required_without_all:client_id,contact_id'],
        ]);
    }

}
