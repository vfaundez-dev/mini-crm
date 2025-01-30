<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

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
        try {

            $validateData = $this->validateRequestData($request, true);
            $validateData['password'] = $this->userRepository->generateHashPassword( $validateData['password'] );

            $this->userRepository->create($validateData);
            return redirect()->route('user.index')->with('success', 'User created.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in UserController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in UserController::store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating user. Try again...')->withInput();
        }
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

    protected function validateRequestData(Request $request, $isCreated = false) {
        return $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:150'] ,
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                ($isCreated ? 'required' : 'nullable'), 'confirmed', Password::min(6)->numbers()->letters()
            ]
                                
        ]);
    }

}
