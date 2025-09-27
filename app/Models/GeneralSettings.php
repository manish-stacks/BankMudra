<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class GeneralSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'main_site_url',
        'currency',
        'language',
        'maintenance_mode',
        'maintenance_text',
    ];
    
   
}
