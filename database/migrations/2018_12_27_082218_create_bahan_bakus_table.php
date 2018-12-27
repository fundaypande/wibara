<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_bakus', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->unique();
            $table->string('jenis_bahan', 191);
            $table->integer('jumlah')->unsigned()->nullable();
            $table->string('satuan', 191)->nullable();
            $table->decimal('harga', 12, 0)->unsigned()->nullable();
            $table->string('asal', 191)->nullable();

            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('casecade');

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
        Schema::dropIfExists('bahan_bakus');
    }
}
