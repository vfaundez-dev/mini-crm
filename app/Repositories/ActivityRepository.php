<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Models\User;
use \Illuminate\Support\Collection;

class ActivityRepository {

  public const STATUS = ['pending', 'in progress', 'completed', 'canceled'];
  public const PRIORITY = ['low', 'medium', 'high'];

  public function all(): Collection {
    return Activity::all();
  }

  public function find(string $id): ?Activity {
    return Activity::find($id);
  }

  public function create(array $data): Activity {
    return Activity::create($data);
  }

  public function update(Activity $activity, array $data): bool {
    return Activity::find($activity->id)->update($data);
  }

  public function delete(Activity $activity): bool {
    return Activity::find($activity->id)->delete();
  }

  public function allOwnerFiltered($ownerId = null): Collection {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Activity::where('owner_id', $ownerId)->get();
  }

  public function status(): array {
    return self::STATUS;
  }

  public function priority(): array {
    return self::PRIORITY;
  }

  public function types(): Collection {
    return \App\Models\ActivityType::all();
  }

}