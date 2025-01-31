<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Log;

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
            'clientStatus' => $this->clientRepository->clientStatus(),
            'clientTypes' => $this->clientRepository->clientType(),
            'clientIndustries' => $this->clientRepository->clientIndustry()
        ]);
    }

    public function store(Request $request) {
        try {

            $validateData = $this->validateRequestData($request);
            $this->clientRepository->create($validateData);
            return redirect()->route('client.index')->with('success', 'Client created.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in ClientController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in ClientController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating client. Try again...')->withInput();
        }
    }

    public function show(string $id) {
        return view('client.show', [
            'client' => $this->clientRepository->find($id)
        ]);
    }

    public function edit(string $id) {
        return view( 'client.form', [
            'owners' => \App\Models\User::listOwners(),
            'clientStatus' => $this->clientRepository->clientStatus(),
            'clientTypes' => $this->clientRepository->clientType(),
            'clientIndustries' => $this->clientRepository->clientIndustry(),
            'client' => $this->clientRepository->find($id),
        ]);
    }

    public function update(Request $request, string $id) {
        try {

            $validateData = $this->validateRequestData($request, $id);
            
            $client = $this->clientRepository->find($id);
            if (!$client) return redirect()->route('client.index')->with(['error' => 'Client not found.']);

            $this->clientRepository->update($client, $validateData);
            return redirect()->route('client.index')->with('success', 'Client updated.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in ClientController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input...')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in ClientController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating client. Try again...')->withInput();
        }
    }

    public function destroy(string $id) {
        try {

            $client = $this->clientRepository->find($id);
            if (!$client) return redirect()->route('client.index')->with(['error' => 'Client not found.']);

            $this->clientRepository->delete($client);
            return redirect()->route('client.index')->with('success', 'Client deleted.');

        } catch (\Throwable $e) {
            Log::error('Error in ClientController::destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting client. Try again...');
        }
    }

    protected function validateRequestData(Request $request, $id = null) {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'status_id' => ['required', 'exists:client_status,id'],
            'type_id' => ['required', 'exists:client_types,id'],
            'industry_id' => ['required', 'exists:client_industries,id'],
            'owner_id' => ['required', 'exists:users,id'],
            'country' => ['required', 'string', 'max:150'],
            'state' => ['nullable', 'string', 'max:150'],
            'city' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'email', ( $id ? 'unique:clients,email,'.$id.',id' : 'unique:clients,email' )],
            'main_phone' => ['required', 'numeric', 'min:8'],
            'secondary_phone' => ['nullable', 'numeric', 'min:8'],
            'address_1' => ['required', 'string', 'max:150'],
            'address_2' => ['nullable', 'string', 'max:150'],
            'address_3' => ['nullable', 'string', 'max:150'],
            'website' => ['nullable', 'string', 'url:http,https']
        ]);
    }

}
