<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller {

    protected $activityRepository;
    protected $clientRepository;
    protected $contactRepository;
    protected static array $validateRules;

    public function __construct(
        ActivityRepository $activityRepository, ClientRepository $clientRepository, ContactRepository $contactRepository
    ) {
        $this->activityRepository = $activityRepository;
        $this->clientRepository = $clientRepository;
        $this->contactRepository = $contactRepository;
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
                'oportunities' => [],
                'types' => $this->activityRepository->types(),
                'statuses' => $this->activityRepository->status(),
                'priorities' => $this->activityRepository->priority()
            ]
        );
    }

    public function store(Request $request) {
        try {

            $validatedData = $request->validate(ActivityController::getValidateRules($this->activityRepository));

            $validatedData = $this->activityRepository->create($validatedData);
            if ($validatedData['status'] == 'completed') $validatedData['completed'] = 1;
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
                'oportunities' => [],
                'types' => $this->activityRepository->types(),
                'statuses' => $this->activityRepository->status(),
                'priorities' => $this->activityRepository->priority(),
                'activity' => $this->activityRepository->find($id),
            ]
        );
    }

    public function update(Request $request, string $id) {
        //
    }

    public function destroy(string $id) {
        //
    }

    public function completed(string $id) {
        try {

            $activity = $this->activityRepository->find($id);
            if (!$activity) return redirect()->back()->withErrors(['error' => 'Activity not found.'])->withInput();

            if ($activity->status == 'completed' && $activity->completed == 1)
                return redirect()->route('activity.index')->with('info', 'Activity has been completed.');

            $this->activityRepository->update($activity, ['completed' => 1, 'status' => 'completed']);
            return redirect()->route('activity.index')->with('success', 'Activity completed.');

        } catch (\Throwable $e) {
            Log::error('Error in ActivityController::completed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting activity. Try again...');
        }
    }

    protected static function getValidateRules(ActivityRepository $activityRepository): array {
        if (!isset(self::$validateRules)) {
            self::$validateRules = [
                'name' => 'required|string|max:150',
                'type_id' => 'required|exists:activity_types,id',
                'status' => 'required|in:' . implode(',', $activityRepository->status()),
                'priority' => 'required|in:' . implode(',', $activityRepository->priority()),
                'owner_id' => 'required|exists:users,id',
                'client_id' => 'nullable|exists:clients,id',
                'contact_id' => 'nullable|exists:contacts,id',
                'opportunity_id' => 'nullable|exists:opportunities,id',
                'description' => 'required|string|max:150',
                'scheduled_date' => 'required|date',
                'end_date' => 'required|date|after:scheduled_date',
                'follow_up_notes' => 'nullable|string|min:5|max:2000',
            ];
        }

        return self::$validateRules;
    }

}
