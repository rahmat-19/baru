<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOltPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('olt_ports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_olt')->references('id')->on('olts')->onDelete('cascade');
            $table->integer('port_number');
            $table->integer('penggunaan')->default(1);
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
        Schema::dropIfExists('olt_ports');
    }
}
