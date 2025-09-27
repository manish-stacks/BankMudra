<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralSettings\Database\factories\LoanTypeFactory;

class LoanType extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'status',
    ];
    
}
