<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pembelian_id');
            $table->uuid('barang_id');
            $table->decimal('qty', 22, 2);
            $table->decimal('price', 22, 2);
            $table->decimal('subtotal', 22, 2);
            $table->decimal('discount_amount', 22, 2);
            $table->decimal('discount_percent', 22, 2);
            //$table->boolean('used_sn');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `pembelian_detail` ADD COLUMN `use_sn` INT(1) DEFAULT 0 NULL AFTER `discount_percent`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_detail');
    }
}
