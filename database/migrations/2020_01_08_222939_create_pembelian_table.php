<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('lokasi_id');
            $table->uuid('relasi_id');
            $table->uuid('user_id');
            $table->char('number',150);
            $table->char('preffix',15);
            $table->char('status',25);
            $table->char('supplier_inv_number', 150);
            $table->char('supplier_do_number', 150);
            $table->char('note', 150);
            $table->date('trans_date');
            $table->date('due_date');
            $table->decimal('subtotal', 22, 2);
            $table->decimal('discount_amount', 22, 2);
            $table->decimal('discount_percent', 22, 2);
            $table->decimal('tax_amount', 22, 2);
            $table->decimal('tax_percent', 22, 2);
            $table->timestamps();

            DB::statement("ALTER TABLE pembelian ADD counter INTEGER(5) DEFAULT 0 NOT NULL AFTER preffix");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
