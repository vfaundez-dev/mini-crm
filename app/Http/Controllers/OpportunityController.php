<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Repositories\OpportunityRepository;
use Illuminate\Http\Request;

class OpportunityController extends Controller {

    protected $opportunityRepository;
    protected $clientRepository;

    public function __construct(OpportunityRepository $opportunityRepository, ClientRepository $clientRepository) {
        $this->opportunityRepository = $opportunityRepository;
        $this->clientRepository = $clientRepository;
    }
    
    public function index(Request $request) {
        $ownerId = $request->get('owner');
        $listStatus = $this->opportunityRepository->listStatus();

        $opportunities = $ownerId 
            ? $this->opportunityRepository->allOwnerFiltered($ownerId) 
            : $this->opportunityRepository->all();

        return view( 'opportunity.index', compact('opportunities', 'listStatus') );
    }

    public function create() {
        return view( 'opportunity.form',
            [
                'owners' => \App\Models\User::listOwners(),
                'listStatus' => $this->opportunityRepository->listStatus(),
                'stages' => \App\Models\OpportunityStage::all(),
                'clients' => $this->clientRepository->all(),
            ]
        );
    }

    public function store(Request $request) {
        //
    }

    public function show(string $id) {
        //
    }

    public function edit(string $id) {
        return view( 'opportunity.form',
            [
                'owners' => \App\Models\User::listOwners(),
                'listStatus' => $this->opportunityRepository->listStatus(),
                'stages' => \App\Models\OpportunityStage::all(),
                'clients' => $this->clientRepository->all(),
                'opportunity' => $this->opportunityRepository->find($id),
            ]
        );
    }

    public function update(Request $request, string $id) {
        //
    }

    public function destroy(string $id) {
        //
    }

    public function close(Request $request, string $id) {
        //
    }

}
