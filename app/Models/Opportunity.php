<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model {
  use HasFactory;

	const STATUS_OPEN = 0;
	const STATUS_CLOSED_LOST = 1;
	const STATUS_CLOSED_WON = 2;

	protected $fillable = [
		'is_active',
		'name',
		'status',
		'stage_id',
		'estimated_value',
		'weighted_value',
		'success_probability',
		'source',
		'created_date',
		'estimated_close_date',
		'actual_close_date',
		'client_id',
		'owner_id',
	];

	public function client(){
		return $this->belongsTo(Client::class);
	}

	public function owner(){
		return $this->belongsTo(User::class, 'owner_id');
	}

	public function stage(){
		return $this->belongsTo(OpportunityStage::class);
	}

	public function activities(){
		return $this->hasMany(Activity::class);
	}

	public static function listStatus() {
		return [
			self::STATUS_OPEN => 'Open',
			self::STATUS_CLOSED_LOST => 'Closed Lost',
			self::STATUS_CLOSED_WON => 'Closed Won',
		];
	}

}
