<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('trans_date');
            $table->uuid('lokasi_id');
            $table->uuid('barang_id');
            $table->char('type',50);
            $table->uuid('ref_main_id');
            $table->uuid('ref_detail_id');
            $table->decimal('qty', 22, 2);
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
        Schema::dropIfExists('stock');
    }
}
