<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Models\User;

class ActivityRepository {

  public const STATUS = ['pending', 'in progress', 'completed', 'canceled'];
  public const PRIORITY = ['low', 'medium', 'high'];

  public function all() {
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

  public function allOwnerFiltered($ownerId = null) {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Activity::where('is_active', 1)->where('owner_id', $ownerId)->get();
  }

  public function status(): array {
    return self::STATUS;
  }

  public function priority(): array {
    return self::PRIORITY;
  }

  public function types() {
    return \App\Models\ActivityType::all();
  }

}