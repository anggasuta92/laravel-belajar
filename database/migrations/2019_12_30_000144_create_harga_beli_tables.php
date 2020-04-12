<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaBeliTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harga_beli', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('barang_id');
            $table->uuid('relasi_id');
            $table->decimal('harga_beli', 22, 2);
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
        Schema::dropIfExists('harga_beli');
    }
}
