<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_stub_number_id')->constrained('survey_stub_numbers')->onUpdate('cascade')->onDelete('restrict');
            $table->string('name', 80)->nullable();
            $table->string('occupation', 80)->nullable();
            $table->date('date')->nullable();
            $table->integer('age')->nullable();
            $table->string('email', 80)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('transact_type', 80);
            $table->string('survey_q_1_1', 50);
            $table->string('survey_q_2', 50);
            $table->string('survey_q_3', 50);
            $table->string('survey_q_4', 50);
            $table->string('survey_q_5', 50);
            $table->string('survey_q_6', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}
