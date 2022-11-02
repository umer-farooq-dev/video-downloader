<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    use HasFactory;

    protected $table = 'user_socials';
    protected $guarded = [];
	protected $hidden = [
		'user_id'
	];
	
	public function users() {
		return $this->belongsTo(User::class);
	}
	
}
