<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model {
  use HasFactory;

	protected $fillable = [
		'is_active',
		'completed',
		'name',
		'status',
		'priority',
		'scheduled_date',
		'end_date',
		'description',
		'follow_up_notes',
		'owner_id',
		'client_id',
		'contact_id',
		'opportunity_id',
		'type_id',
	];

	public function owner(){
		return $this->belongsTo(User::class, 'owner_id');
	}

	public function client(){
		return $this->belongsTo(Client::class);
	}

	public function contact(){
		return $this->belongsTo(Contact::class);
	}

	public function opportunity(){
		return $this->belongsTo(Opportunity::class);
	}

	public function type() {
		return $this->belongsTo(ActivityType::class, 'type_id');
	}

}
