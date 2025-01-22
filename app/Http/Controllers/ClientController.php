<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ClientRepository;

class ClientController extends Controller {

    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;
    }
    
    public function index() {
        $clients = $this->clientRepository->all();
        return view( 'clients.index', compact('clients') );
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
