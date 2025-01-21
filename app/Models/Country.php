<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model {
  use HasFactory;

	public function state(){
		return $this->hasOne(State::class);
	}

	public function clients(){
		return $this->hasMany(Client::class);
	}

	public function contacts(){
		return $this->hasMany(Contact::class);
	}

}
