<?php

namespace App\Repositories;

use App\Models\Opportunity;
use App\Models\OpportunityStage;
use App\Models\User;
use \Illuminate\Support\Collection;

class OpportunityRepository {

  const STATUS_OPEN = 0;
  const STATUS_CLOSED_LOST = 1;
  const STATUS_CLOSED_WON = 2;

  public function all(): Collection {
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

  public function allOwnerFiltered($ownerId = null): Collection {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Opportunity::where('owner_id', $ownerId)->get();
  }

  public static function listStatus(): array {
    return [
      self::STATUS_OPEN => 'Open',
      self::STATUS_CLOSED_LOST => 'Closed Lost',
      self::STATUS_CLOSED_WON => 'Closed Won',
    ];
  }

  public static function opportunitiesByStage(): array {
    return OpportunityStage::selectRaw('stage, 1 as total')
      ->groupBy('stage')
      ->pluck('total', 'stage')
      ->toArray();

    return Opportunity::leftJoin('opportunity_stages', 'opportunities.stage_id', '=', 'opportunity_stages.id')
      ->selectRaw('opportunity_stages.stage, COUNT(opportunities.id) as total')
      ->groupBy('opportunity_stages.stage')
      ->pluck('total', 'stage')
      ->toArray();
  }

}