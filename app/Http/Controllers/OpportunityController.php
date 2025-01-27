<?php

namespace App\Http\Controllers;

use App\Repositories\OpportunityRepository;
use Illuminate\Http\Request;

class OpportunityController extends Controller {

    protected $opportunityRepository;

    public function __construct(OpportunityRepository $opportunityRepository) {
        $this->opportunityRepository = $opportunityRepository;
    }
    
    public function index(Request $request) {
        $ownerId = $request->get('owner');

        $opportunities = $ownerId 
            ? $this->opportunityRepository->allOwnerFiltered($ownerId) 
            : $this->opportunityRepository->all();

        return view( 'opportunity.index', compact('opportunities') );
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(string $id) {
        //
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
