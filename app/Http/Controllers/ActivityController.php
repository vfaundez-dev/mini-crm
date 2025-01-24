<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller {

    protected $activityRepository;

    public function __construct(ActivityRepository $activityRepository) {
        $this->activityRepository = $activityRepository;
    }
    
    public function index(Request $request) {
        $ownerId = $request->get('owner');

        $activities = $ownerId 
            ? $this->activityRepository->allOwnerFiltered($ownerId) 
            : $this->activityRepository->all();

        return view( 'activity.index', compact('activities') );
    }

    public function create() {
        //
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
        //
    }

    public function update(Request $request, string $id) {
        //
    }

    public function destroy(string $id) {
        //
    }

}
