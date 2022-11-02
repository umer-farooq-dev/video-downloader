<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $guarded = [];

	public function children()
	{
	    return $this->hasMany(Menu::class, 'parent_id', 'id')->with('children')->orderBy('sort', 'ASC');
	}
    
}
