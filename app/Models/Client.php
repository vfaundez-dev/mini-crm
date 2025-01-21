<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model{
  use HasFactory;

	protected $fillable = [
		'is_active',
		'name',
		'status_id',
		'type_id',
		'industry_id',
		'email',
		'main_phone',
		'secondary_phone',
		'country_id',
		'state_id',
		'city_id',
		'address_1',
		'address_2',
		'address_3',
		'website',
		'owner_id',
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

	public function country(){
		return $this->belongsTo(Country::class);
	}

	public function state(){
		return $this->belongsTo(State::class);
	}

	public function city(){
		return $this->belongsTo(City::class);
	}
	
}
