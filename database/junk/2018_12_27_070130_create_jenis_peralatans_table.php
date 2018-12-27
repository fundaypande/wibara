<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisPeralatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_peralatans', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->unique();
            $table->string('jenis_alat', 191);
            $table->integer('tahun')->unsigned();
            $table->text('spesifikasi');
            $table->string('kapasitas', 191);
            $table->integer('jumlah')->unsigned();
            $table->string('buatan', 191);
            $table->integer('harga')->unsigned();
            $table->string('asal', 191);

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
        Schema::dropIfExists('jenis_peralatans');
    }
}
