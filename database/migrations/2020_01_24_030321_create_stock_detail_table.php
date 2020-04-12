<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('trans_date');
            $table->uuid('lokasi_id');
            $table->uuid('barang_id');
            $table->uuid('stock_id');
            $table->char('serial_number',50);
            $table->decimal('in_out', 2, 0);
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
        Schema::dropIfExists('stock_detail');
    }
}
