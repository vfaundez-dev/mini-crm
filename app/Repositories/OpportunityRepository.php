<?php

namespace App\Repositories;

use App\Models\Opportunity;
use App\Models\User;

class OpportunityRepository {

  const STATUS_OPEN = 0;
  const STATUS_CLOSED_LOST = 1;
  const STATUS_CLOSED_WON = 2;

  public function all() {
    return Opportunity::all();
  }

  public function find(string $id): ?Opportunity {
    return Opportunity::find($id);
  }

  public function create(array $data): Opportunity {
    return Opportunity::create($data);
  }

  public function update(Opportunity $opportunity, array $data): bool {
    return Opportunity::find($opportunity->id)->update($data);
  }

  public function delete(Opportunity $opportunity): bool {
    return Opportunity::find($opportunity->id)->delete();
  }

  public function allOwnerFiltered($ownerId = null) {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Opportunity::where('owner_id', $ownerId)->get();
  }

  public static function listStatus() {
    return [
      self::STATUS_OPEN => 'Open',
      self::STATUS_CLOSED_LOST => 'Closed Lost',
      self::STATUS_CLOSED_WON => 'Closed Won',
    ];
  }

}