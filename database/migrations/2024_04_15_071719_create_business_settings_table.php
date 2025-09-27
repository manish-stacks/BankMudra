<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->string('type',30);
            $table->longText('value')->nullable();;
            $table->string('lang',30)->nullable()->default('en');
            $table->timestamps();
        });

        $settings = array(
            array('type' => "website_name", 'value' => 'Hover'),
            array('type' => "site_motto", 'value' => 'Hover'),
            array('type' => "meta_description", 'value' => 'Hover'),
            array('type' => "meta_keywords", 'value' => 'Hover'),
            array('type' => "header_script", 'value' => ''),
            array('type' => "footer_script", 'value' => ''),
        );
        DB::table('business_settings')->insert($settings);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_settings');
    }
};
