<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ContactRepository;
use App\Repositories\OpportunityRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    protected $clientRepository;
    protected $contactRepository;
    protected $activityRepository;
    protected $opportunityRepository;

    public function __construct(
        ClientRepository $clientRepository,
        ContactRepository $contactRepository,
        ActivityRepository $activityRepository,
        OpportunityRepository $opportunityRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->contactRepository = $contactRepository;
        $this->activityRepository = $activityRepository;
        $this->opportunityRepository = $opportunityRepository;
    }

    public function index() {
        return view('dashboard.index', [
            'clients' => $this->clientRepository->all(),
            'contacts' => $this->contactRepository->all(),
            'activities' => $this->activityRepository->all(),
            'opportunities' => $this->opportunityRepository->all(),
        ]);
    }
    
}
