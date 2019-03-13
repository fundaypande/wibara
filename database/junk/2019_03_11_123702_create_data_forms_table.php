<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_forms', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('form_id');
            $table->integer('butir_id');
            $table->string('name');
            $table->string('email');
            $table->string('affiliation');
            $table->tinyInteger('nilai');


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
        Schema::dropIfExists('data_forms');
    }
}
