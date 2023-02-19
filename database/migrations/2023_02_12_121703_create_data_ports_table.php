<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->foreignId('id_port');
            $table->enum('jenisPembangunan', ['PT 2', 'PT 3']);
            $table->string('id_pengajuan');
            $table->string('labelODP');
            $table->string('labelODC');
            $table->string('distribusi');
            $table->string('alamat');
            $table->integer('jumlahODP');
            $table->enum('usulan', ['pembangunan sttf', 'normalisasi']);
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
        Schema::dropIfExists('data_ports');
    }
}
