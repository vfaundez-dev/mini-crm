<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService) {
        $this->dashboardService = $dashboardService;
    }

    public function index() {
        return view('dashboard.index', [
            'totals' => $this->dashboardService->getTotals(),
            'opportunitiesByStage' => $this->dashboardService->getOpportunitiesByStage(),
        ]);
    }
    
}
