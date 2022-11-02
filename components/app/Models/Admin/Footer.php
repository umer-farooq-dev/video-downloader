<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Footer extends Model
{
    use Translatable, HasFactory;

    public $translatedAttributes = ['widget1', 'widget2', 'widget3', 'widget4', 'widget5', 'bottom_text'];
    protected $fillable          = [];

    protected $table = 'footers';

    protected $guarded = [];
}
