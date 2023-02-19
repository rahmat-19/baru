<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOltsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('olts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sto');
            $table->string('hostname')->unique();
            $table->string('ip')->unique();
            $table->enum('merk', ['ZTE', 'HUAWEI', 'FIBERHIOME']);
            $table->enum('type', ['C320', 'C630', 'MA5600T', 'AN5000', 'AN6000']);
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
        Schema::dropIfExists('olts');
    }
}
