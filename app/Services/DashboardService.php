<?php

namespace App\Services;

use App\Repositories\ActivityRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ContactRepository;
use App\Repositories\OpportunityRepository;
use Illuminate\Support\Collection;

class DashboardService {

  protected Collection $clients;
  protected Collection $contacts;
  protected Collection $activities;
  protected Collection $opportunities;

  public function __construct(
    ClientRepository $clientRepository,
    ContactRepository $contactRepository,
    ActivityRepository $activityRepository,
    OpportunityRepository $opportunityRepository
  ) {
    $this->clients = collect($clientRepository->all());
    $this->contacts = collect($contactRepository->all());
    $this->activities = collect($activityRepository->all());
    $this->opportunities = collect($opportunityRepository->all());
  }

  public function getTotals() {
    return [
      'clients' => $this->clients->count(),
      'contacts' => $this->contacts->count(),
      'activities' => $this->activities->count(),
      'opportunities' => $this->opportunities->count(),
    ];
  }

  public function getOpportunitiesByStage() {
    return OpportunityRepository::opportunitiesByStage();
  }

}