<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVoucherCodeInSurveyStubNumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('survey_stub_numbers', function (Blueprint $table) {
            $table->string('voucher_code', 15);
            $table->foreignId('shop_id')->constrained('shops')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_stub_numbers', function (Blueprint $table) {
            //
        });
    }
}
