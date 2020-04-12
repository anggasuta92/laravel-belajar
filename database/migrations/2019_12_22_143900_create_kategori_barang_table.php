<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('kategori_barang');
        Schema::create('kategori_barang', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->uuid('id')->primary();
            $table->char('code',5);
            $table->char('name',100);
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
        Schema::table('kategori_barang', function (Blueprint $table) {
            //
        });
    }
}
