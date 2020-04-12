<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('lokasi');
        Schema::create('lokasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('code', 50);
            $table->char('name', 50);
            $table->char('address', 150);
            $table->char('phone', 150);
            $table->char('pic', 150);
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
        Schema::dropIfExists('lokasi');
    }
}
