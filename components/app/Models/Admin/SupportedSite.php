<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedSite extends Model
{
    use HasFactory;
    protected $table = 'supported_sites';
    protected $guarded = [];
}
