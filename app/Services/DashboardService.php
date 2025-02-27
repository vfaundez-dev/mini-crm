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

  public function getEstimatedRevenue(): float {
    return $this->opportunities->sum( fn($row) => $row->estimated_value * ($row->success_probability / 100) );
  }

  public function totalValue(): float {
    return $this->opportunities->sum('estimated_value');
  }

  public function getActivitiesProgress() {
    return [
      'pending' => $this->activities->where('status', ActivityRepository::STATUS[0])->count(),
      'in_progress' => $this->activities->where('status', ActivityRepository::STATUS[1])->count(),
      'completed' => $this->activities->where('status', ActivityRepository::STATUS[2])->count(),
      'canceled' => $this->activities->where('status', ActivityRepository::STATUS[3])->count(),
    ];
  }

}