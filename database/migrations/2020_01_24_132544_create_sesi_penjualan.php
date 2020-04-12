<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesiPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesi_penjualan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('lokasi_id');
            $table->datetime('open_date');
            $table->decimal('open_amount', 22, 2);
            $table->datetime('close_date');
            $table->decimal('close_amount', 22, 2);
            $table->decimal('sales_amount', 22, 2);
            $table->char('status', 15);
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
        Schema::dropIfExists('sesi_penjualan');
    }
}
