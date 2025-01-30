<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    public function index() {
        $users = $this->userRepository->all();
        return view( 'user.index', compact('users') );
    }

    public function create() {
        return view('user.form');
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
