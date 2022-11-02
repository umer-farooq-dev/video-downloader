<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    use HasFactory;
    protected $table = 'proxies';
    protected $guarded = [];
    protected $casts = [
        'banned' => 'boolean',
    ];
}
