<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExemplariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemplaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('works_id');
            $table->foreign('works_id')->references('id')->on('works');
            $table->date('acquisition_date');
            $table->integer('situation');
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
        Schema::dropIfExists('exemplaries');
    }
}
