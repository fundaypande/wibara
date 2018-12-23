<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilikmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profilikm', function (Blueprint $table) {
            $table->increments('id');

            //additional
            $table->integer('user_id')->unsigned()->unique();
            $table->string('nama_usaha', 191)->nullable();
            $table->tinyinteger('lama_berdiri')->nullable();
            $table->string('merk_produk', 191)->nullable();
            $table->string('alamat', 191)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('desa', 100)->nullable();
            $table->string('telpon', 15)->nullable();
            $table->string('jenis_produk', 191)->nullable();
            $table->integer('rerata_produksi')->nullable();
            $table->decimal('rerata_harga', 10, 2)->nullable();
            $table->decimal('rerata_penjualan', 12, 2)->nullable();
            $table->string('tempat_pemasaran', 191)->nullable();
            $table->integer('total_peralatan')->nullable();
            $table->integer('total_bahan_baku')->nullable();
            $table->integer('total_pekerja')->nullable();
            $table->integer('jarak')->nullable();
            $table->text('permasalahan')->nullable();
            $table->string('jenis_bimtek', 191)->nullable();
            $table->string('long', 20)->nullable();
            $table->string('lang', 20)->nullable();

            $table->boolean('status')->default(0);


            $table->index('user_id');
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
        Schema::dropIfExists('profilikm');
    }
}
