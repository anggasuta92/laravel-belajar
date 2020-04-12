<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('barang');
        Schema::create('barang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('code',15)->unique();
            $table->char('barcode',25)->unique();
            $table->char('name',150)->unique();
            $table->uuid('kategori_id');
            $table->uuid('satuan_id');
            $table->uuid('merk_id');
            $table->decimal('hpp', 22, 2);
            $table->decimal('harga_jual', 22, 2);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE barang ADD counter INTEGER(5) DEFAULT 0 NOT NULL AFTER code");
        DB::statement("ALTER TABLE `barang` ADD COLUMN `use_sn` INT(1) DEFAULT 0 NULL AFTER `merk_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
