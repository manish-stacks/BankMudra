<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'party_code',
        'cust_id',
        'party_name',
        'father_name',
        'account_group',
        'group',
        'address',
        'area',
        'city',
        'state',
        'pincode',
        'mobile_no',
        'mobile_no2',
        'ref1_name',
        'ref1_father_name',
        'ref1_mobile',
        'ref1_relation',
        'ref1_address',
        'ref1_pan_no',
        'ref1_aadhaar_no',
        'ref1_voter_id',
        'ref1_birthdate',
        'ref1_gender',
        'ref1_pincode',
        'ref2_name',
        'ref2_father_name',
        'ref2_mobile',
        'ref2_relation',
        'ref2_address',
        'ref2_pan_no',
        'ref2_aadhaar_no',
        'ref2_voter_id',
        'ref2_birthdate',
        'ref2_gender',
        'ref2_pincode',
        'email',
        'balance',
        'loan_limit',
        'bank_name',
        'branch',
        'account_no',
        'account_holder',
        'pan_no',
        'aadhaar_no',
        'occupation',
        'voter_id',
        'birthdate',
        'gender',
        'remarks',
        'profile',
        'pan',
        'aadhaar',
        'status',
        'password',
        'created_by',
    ];
}
