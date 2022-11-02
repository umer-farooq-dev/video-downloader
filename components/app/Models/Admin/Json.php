<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Json extends Model
{
    use HasFactory;
    protected $table = 'jsons';
    protected $guarded = [];
    protected $casts = [
        'status' => 'boolean',
    ];
}
