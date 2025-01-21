<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model {
  use HasFactory;

	public function state() {
		return $this->belongsTo(Country::class);
	}

	public function city(){
		return $this->hasOne(City::class);
	}

	public function clients(){
		return $this->hasMany(Client::class);
	}

	public function contacts(){
		return $this->hasMany(Contact::class);
	}
	
}
