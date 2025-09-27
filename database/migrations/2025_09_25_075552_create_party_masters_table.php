<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('party_masters', function (Blueprint $table) {
            $table->id();
            $table->string('party_code')->nullable();
            $table->string('cust_id')->nullable();
            $table->string('party_name');
            $table->string('father_name')->nullable();
            $table->string('account_group')->nullable();
            $table->string('group')->nullable();
            $table->text('address')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('mobile_no2')->nullable();

            // Reference 1
            $table->string('ref1_name')->nullable();
            $table->string('ref1_father_name')->nullable();
            $table->string('ref1_mobile')->nullable();
            $table->string('ref1_relation')->nullable();
            $table->text('ref1_address')->nullable();
            $table->string('ref1_pan_no')->nullable();
            $table->string('ref1_aadhaar_no')->nullable();
            $table->string('ref1_voter_id')->nullable();
            $table->date('ref1_birthdate')->nullable();
            $table->string('ref1_gender')->nullable();
            $table->string('ref1_pincode')->nullable();

            // Reference 2
            $table->string('ref2_name')->nullable();
            $table->string('ref2_father_name')->nullable();
            $table->string('ref2_mobile')->nullable();
            $table->string('ref2_relation')->nullable();
            $table->text('ref2_address')->nullable();
            $table->string('ref2_pan_no')->nullable();
            $table->string('ref2_aadhaar_no')->nullable();
            $table->string('ref2_voter_id')->nullable();
            $table->date('ref2_birthdate')->nullable();
            $table->string('ref2_gender')->nullable();
            $table->string('ref2_pincode')->nullable();

            // Other details
            $table->string('email')->nullable();
            $table->decimal('balance', 15, 2)->default(0);
            $table->string('loan_limit')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_no')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('aadhaar_no')->nullable();
            $table->string('occupation')->nullable();
            $table->string('voter_id')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->text('remarks')->nullable();
            $table->string('aadhaar', 12)->nullable();
            $table->string('pan', 15)->nullable();
            $table->string('profile', 15)->nullable();
            $table->string('status')->default('active');
            $table->string('password')->nullable();
            $table->string('created_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_masters');
    }
};
