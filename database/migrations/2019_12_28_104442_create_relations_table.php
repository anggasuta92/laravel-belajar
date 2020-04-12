<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('code', 15);
            $table->char('id_card_number', 50);
            $table->char('tax_id_number', 50);
            $table->char('name', 25);
            $table->char('address', 100);
            $table->char('phone', 100);
            $table->char('email', 100);
            $table->char('website', 100);
            $table->decimal('ar_limit', 22,2);
            $table->decimal('ap_limit', 22,2);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE relasi ADD type INTEGER(2) DEFAULT 0 NOT NULL AFTER id");
        DB::statement("ALTER TABLE relasi ADD counter INTEGER(5) DEFAULT 0 NOT NULL AFTER code");
        DB::statement("ALTER TABLE .`relasi` CHANGE `id_card_number` `id_card_number` CHAR(50) CHARSET latin1 COLLATE latin1_swedish_ci DEFAULT '' NULL, CHANGE `tax_id_number` `tax_id_number` CHAR(50) CHARSET latin1 COLLATE latin1_swedish_ci DEFAULT '' NULL, CHANGE `name` `name` CHAR(25) CHARSET latin1 COLLATE latin1_swedish_ci DEFAULT '' NULL, CHANGE `address` `address` CHAR(100) CHARSET latin1 COLLATE latin1_swedish_ci DEFAULT '' NULL, CHANGE `phone` `phone` CHAR(100) CHARSET latin1 COLLATE latin1_swedish_ci DEFAULT '' NULL, CHANGE `email` `email` CHAR(100) CHARSET latin1 COLLATE latin1_swedish_ci DEFAULT '' NULL, CHANGE `website` `website` CHAR(100) CHARSET latin1 COLLATE latin1_swedish_ci DEFAULT '' NULL, CHANGE `ar_limit` `ar_limit` DECIMAL(22,2) NULL, CHANGE `ap_limit` `ap_limit` DECIMAL(22,2) NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relasi');
    }
}
