<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_produksis', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->unique();
            $table->string('jenis_produksi', 191);
            $table->integer('jumlah')->nullable();
            $table->string('merk_produk', 191)->nullable();
            $table->decimal('harga', 12,0)->nullable();
            $table->decimal('nilai_penjualan', 12,0)->nullable();
            $table->string('tujuan', 191)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('photo', 191)->nullable();

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
        Schema::dropIfExists('nilai_produksis');
    }
}
