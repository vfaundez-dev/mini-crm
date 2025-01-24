<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller {

    protected $contactRepository;
    protected $clientRepository;
    protected const VALIDATE_RULES = [
        'first_name' => 'required|string|max:150',
        'last_name' => 'required|string|max:150',
        'gender' => 'required|in:male,female,other',
        'job_title_id' => 'required|exists:contact_job_titles,id',
        'department_id' => 'required|exists:contact_departments,id',
        'client_id' => 'nullable|exists:clients,id',
        'email' => 'required|email|unique:contacts,email',
        'phone' => 'required|numeric|min:8',
        'address' => 'nullable|string|min:6',
        'country' => 'required|string|max:150',
        'state' => 'nullable|string|max:150',
        'city' => 'nullable|string|max:150',
    ];

    public function __construct(ContactRepository $contactRepository, ClientRepository $clientRepository) {
        $this->contactRepository = $contactRepository;
        $this->clientRepository = $clientRepository;
    }
    
    public function index(Request $request) {
        $ownerId = $request->get('owner');

        $contacts = $ownerId 
            ? $this->contactRepository->allOwnerFiltered($ownerId) 
            : $this->contactRepository->all();

        return view( 'contact.index', compact('contacts') );
    }

    public function create() {
        return view( 'contact.form',
            [
                'clients' => $this->clientRepository->all(),
                'jobsTitles' => $this->contactRepository->contactJobTitles(),
                'departments' => $this->contactRepository->ContactDepartments(),
            ]
        );
    }

    public function store(Request $request) {
        try {

            $validatedData = $request->validate(self::VALIDATE_RULES);
            $validatedData['full_name'] = $this->contactRepository->fullName($validatedData['first_name'], $validatedData['last_name']);
            $this->contactRepository->create($validatedData);
            return redirect()->route('contact.index')->with('success', 'Contact created.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in ContactController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in ContactController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating contact. Try again...')->withInput();
        }
    }

    public function show(string $id) {
        return view( 'contact.show', [
            'contact' => $this->contactRepository->find($id)
        ]);
    }

    public function edit(string $id) {
        return view( 'contact.form',
            [
                'clients' => $this->clientRepository->all(),
                'jobsTitles' => $this->contactRepository->contactJobTitles(),
                'departments' => $this->contactRepository->contactDepartments(),
                'contact' => $this->contactRepository->find($id),
            ]
        );
    }

    public function update(Request $request, string $id) {
        try {

            $rules = self::VALIDATE_RULES;
            $rules['email'] .= ',' . $id; // Ignore current contact email rule
            $validatedData = $request->validate($rules);
            $validatedData['full_name'] = $this->contactRepository->fullName($validatedData['first_name'], $validatedData['last_name']);

            $contact = $this->contactRepository->find($id);
            if (!$contact) return redirect()->route('contact.index')->withErrors(['error' => 'Contact not found.']);

            $this->contactRepository->update($contact, $validatedData);
            return redirect()->route('contact.index')->with('success', 'Contact updated.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in ContactController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input...')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in ContactController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating contact. Try again...')->withInput();
        }
    }

    public function destroy(string $id) {
        try {

            $contact = $this->contactRepository->find($id);
            if (!$contact) return redirect()->route('contact.index')->withErrors(['error' => 'Contact not found.']);

            $this->contactRepository->delete($contact);
            return redirect()->route('contact.index')->with('success', 'Contact deleted.');

        } catch (\Throwable $e) {
            Log::error('Error in ContactController::destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting contact. Try again...');
        }
    }

}
