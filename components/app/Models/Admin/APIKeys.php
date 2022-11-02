<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIKeys extends Model
{
    use HasFactory;
    protected $table = 'api_keys';
    protected $guarded = [];
    
}
