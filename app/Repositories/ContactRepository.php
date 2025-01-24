<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\User;

class ContactRepository {

  public function all() {
    return Contact::all();
  }

  public function allOwnerFiltered($ownerId = null) {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Contact::where('is_active', 1)->where('owner_id', $ownerId)->get();
  }

}