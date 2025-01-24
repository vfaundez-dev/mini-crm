<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\User;

class ContactRepository {

  public function all() {
    return Contact::all();
  }

  public function find(string $id): ?Contact {
    return Contact::find($id);
  }

  public function fullName(string $first_name, string $last_name): string {
    return trim($first_name . ' ' . $last_name);
  }

  public function allOwnerFiltered($ownerId = null) {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Contact::where('is_active', 1)->where('owner_id', $ownerId)->get();
  }

}