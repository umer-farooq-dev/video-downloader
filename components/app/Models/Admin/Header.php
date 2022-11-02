<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
    protected $table = 'headers';
    protected $guarded = [];
    protected $casts = [
        'sticky_header'        => 'boolean',
    ];
}
