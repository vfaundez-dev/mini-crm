<?php

namespace App\Repositories;

use App\Models\Opportunity;

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

}