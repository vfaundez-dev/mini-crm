<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Models\User;

class ActivityRepository {

  public function all() {
    return Activity::all();
  }

  public function allOwnerFiltered($ownerId = null) {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Activity::where('is_active', 1)->where('owner_id', $ownerId)->get();
  }

}