<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
  use HasFactory;

	protected $fillable = [
		'is_active',
		'first_name',
		'last_name',
		'full_name',
		'gender',
		'job_title_id',
		'department_id',
		'email',
		'phone',
		'address',
		'country_id',
		'state_id',
		'city_id',
		'client_id',
	];

	public function client(){
		return $this->belongsTo(Client::class);
	}

	public function job_title(){
		return $this->belongsTo(ContactJobTitle::class);
	}

	public function department(){
		return $this->belongsTo(ContactDepartment::class);
	}

	public function activities(){
		return $this->hasMany(Activity::class);
	}
	
}
