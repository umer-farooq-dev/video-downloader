<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gdpr extends Model
{
    use HasFactory;
    protected $table = 'gdprs';
    protected $guarded = [];
    protected $casts = [
        'status'      => 'boolean',
    ];
}
