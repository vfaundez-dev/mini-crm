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
        //
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

}
