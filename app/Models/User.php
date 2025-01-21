<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
	use HasApiTokens, HasFactory, Notifiable;

	protected $fillable = [
		'is_active',
		'name',
		'email',
		'password',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
	];

	public function clients() {
		return $this->hasMany(Client::class, 'owner_id');
	}

	public function activities() {
		return $this->hasMany(Activity::class, 'owner_id');
	}

	public function opportunities() {
		return $this->hasMany(Opportunity::class, 'owner_id');
	}

	public static function listOwners() {
		return User::all()->where('is_active', 1);
	}
	
}
