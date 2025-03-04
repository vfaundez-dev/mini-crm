<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class DashboardController extends Controller {

    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService) {
        $this->dashboardService = $dashboardService;
    }

    public function index() {
        return view('dashboard.index', [
            'totals' => $this->dashboardService->getTotals(),
            'opportunitiesByStage' => $this->dashboardService->getOpportunitiesByStage(),
            'totalValue' => number_format($this->dashboardService->totalValue(), 2, ',', '.'),
            'opportunitiesEstimatedRevenue' => number_format($this->dashboardService->getEstimatedRevenue(), 2, ',', '.'),
            'getActivitiesProgress' => $this->dashboardService->getActivitiesProgress(),
            'getOpportunitiesPipeline' => $this->dashboardService->getOpportunitiesPipeline(),
            'getLastActivities' => $this->dashboardService->getLastActivities(),
            'getLastClients' => $this->dashboardService->getLastClients(),
            'topUsersClosedWonOpp' => $this->dashboardService->topUsersClosedWonOpp(),
        ]);
    }
    
}
