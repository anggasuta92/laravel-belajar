<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerialNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('serial_number');
        Schema::create('serial_number', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('serial_number',50);
            $table->char('ref_type',50); /* type string :pembelian :penjualan :adjusment */
            $table->uuid('ref_id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE serial_number ADD in_out INTEGER(5) DEFAULT 0 NOT NULL AFTER serial_number");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serial_number');
    }
}
