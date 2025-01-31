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

            $validateData = $this->validateRequestData($request);
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
        $user = $this->userRepository->find($id);
        return view('user.show', [
            'user' => $user ?? [],
            'detailsUser' => $this->userRepository->getDetailsUser($user)
        ]);
    }

    public function edit(string $id) {
        return view( 'user.form', [
            'user' => $this->userRepository->find($id),
        ]);
    }

    public function update(Request $request, string $id) {
        try {

            $validateData = $this->validateRequestData($request, $id);
            $user = $this->userRepository->find($id);
            if (!$user) return redirect()->route('user.index')->withErrors(['error' => 'User not found.']);

            data_forget($validateData, 'email'); // Skip email
            $validateData['password'] =  $validateData['password']
                ? $this->userRepository->generateHashPassword($validateData['password'])
                : $user->password;

            $this->userRepository->update($user, $validateData);
            return redirect()->route('user.index')->with('success', 'User updated.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in UserController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in UserController::update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating user. Try again...')->withInput();
        }
    }

    public function destroy(string $id) {
        try {

            $user = $this->userRepository->find($id);
            if (!$user) return redirect()->route('user.index')->withErrors(['error' => 'User not found.']);

            $this->userRepository->delete($user);
            return redirect()->route('user.index')->with('success', 'User deleted.');

        } catch (\Throwable $e) {
            Log::error('Error in UserController::destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting user. Try again...');
        }
    }

    public function changePassword(Request $request, string $id) {
        try {

            $user = $this->userRepository->find($id);
            if (!$user) return redirect()->route('user.show')->withErrors(['error' => 'User not found.']);

            $validateData = $request->validate([
                'password' => [ 'required', 'confirmed', Password::min(6)->numbers()->letters() ]
            ]);

            $password = $this->userRepository->generateHashPassword( $validateData['password'] );

            $this->userRepository->update($user, ['password' => $password]);
            return redirect()->route('user.index')->with('success', 'Updated user password.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error in UserController::changePassword: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please check your input.')->withInput();
        } catch (\Exception $e) {
            Log::error('Exception error in UserController::changePassword: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error change password to user. Try again...')->withInput();
        }
    }

    protected function validateRequestData(Request $request, $userId = null) {
        return $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:150'] ,
            'email' => [
                'required','email', ( $userId ? 'unique:users,email,'.$userId.',id' : 'unique:users,email' )
            ],
            'password' => [
                $userId ? 'nullable' : 'required', 'confirmed', Password::min(6)->numbers()->letters(),
            ]
                                
        ]);
    }

}
