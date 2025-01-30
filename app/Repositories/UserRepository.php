<?php

namespace App\Repositories;

use App\Models\User;

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

}