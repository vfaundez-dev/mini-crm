<?php

namespace App\Http\Controllers;

use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller {

    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository) {
        $this->contactRepository = $contactRepository;
    }
    
    public function index(Request $request) {
        $ownerId = $request->get('owner');

        $contacts = $ownerId 
            ? $this->contactRepository->allOwnerFiltered($ownerId) 
            : $this->contactRepository->all();

        return view( 'contact.index', compact('contacts') );
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
