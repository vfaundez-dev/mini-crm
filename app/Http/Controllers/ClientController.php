<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ClientRepository;

class ClientController extends Controller {

    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;
    }
    
    public function index(Request $request) {
        $ownerId = $request->get('owner');

        $clients = $ownerId 
            ? $this->clientRepository->allOwnerFiltered($ownerId) 
            : $this->clientRepository->all();

        return view( 'client.index', compact('clients') );
    }

    public function create() {
        return view( 'client.form', [
            'owners' => \App\Models\User::listOwners(),
            'clientStatus' => \App\Models\ClientStatus::all(),
            'clientTypes' => \App\Models\ClientType::all(),
            'clientIndustries' => \App\Models\ClientIndustry::all()
        ]);
    }

    public function store(Request $request) {
        //
    }

    public function show(string $id) {
        return view('client.show', [
            'client' => $this->clientRepository->find($id)
        ]);
    }

    public function edit(string $id) {
        return view( 'client.form', [
            'owners' => \App\Models\User::listOwners(),
            'clientStatus' => \App\Models\ClientStatus::all(),
            'clientTypes' => \App\Models\ClientType::all(),
            'clientIndustries' => \App\Models\ClientIndustry::all(),
            'client' => $this->clientRepository->find($id),
        ]);
    }

    public function update(Request $request, string $id) {
        //
    }

    public function destroy(string $id) {
        //
    }

}
