<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterTranslation extends Model
{
    use HasFactory;

    protected $table    = 'footer_translations';
    protected $guarded  = [];
    
    public $timestamps  = false;

    protected $fillable = ['widget1', 'widget2', 'widget3', 'widget4', 'widget5', 'bottom_text'];
}
