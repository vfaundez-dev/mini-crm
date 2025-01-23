<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model{
  use HasFactory;

	protected $fillable = [
		'is_active',
		'name',
		'email',
		'main_phone',
		'secondary_phone',
		'address_1',
		'address_2',
		'address_3',
		'website',
		'country',
		'state',
		'city',
		'owner_id',
		'industry_id',
		'status_id',
		'type_id'
	];

	public function owner(){
		return $this->belongsTo(User::class, 'owner_id');
	}

	public function contacts(){
		return $this->hasMany(Contact::class);
	}

	public function opportunities(){
		return $this->hasMany(Opportunity::class);
	}

	public function activities(){
		return $this->hasMany(Activity::class);
	}

	public function status(){
		return $this->belongsTo(ClientStatus::class);
	}

	public function type(){
		return $this->belongsTo(ClientType::class);
	}

	public function industry(){
		return $this->belongsTo(ClientIndustry::class);
	}
	
}
