<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {

  public function all() {
    return User::all();
  }

  public function find(string $id): ?User {
    return User::find($id);
  }

  public function create(array $data): User {
    return User::create($data);
  }

  public function update(User $user, array $data): bool {
    return User::find($user->id)->update($data);
  }

  public function delete(User $user): bool {
    return User::find($user->id)->delete();
  }

  public function generateHashPassword($password): string {
    return Hash::make( $password );
  }

  public function getDetailsUser(User $user): array {
    return [
      'clients' => $user->clients()->count() ?? '',
      'activities' => $user->activities()->count() ?? '',
      'opportunities' => $user->opportunities()->count() ?? ''
    ];
  }

  public function updatePassword(User $user, array $data): bool {
    return User::find($user->id)->update($data);
  }

}