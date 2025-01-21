<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactJobTitle extends Model {
  use HasFactory;

	public function contact(){
		return $this->hasOne(Contact::class);
	}
	
}
