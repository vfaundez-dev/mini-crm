<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunityStage extends Model {
  use HasFactory;

  public function opportunity() {
    return $this->hasMany(Opportunity::class);
  }

}
