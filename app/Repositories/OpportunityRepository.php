<?php

namespace App\Repositories;

use App\Models\Opportunity;
use App\Models\User;

class OpportunityRepository {

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

}