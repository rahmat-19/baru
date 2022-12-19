<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_ports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_port')->references('id')->on('olt_ports')->onDelete('cascade');
            $table->string('waspang');
            $table->enum('jenisPembangunan', ['ODC', 'ODP']);
            $table->string('label');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('info_ports');
    }
}
