<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengajuan')->unique();
            $table->foreignId('id_slot');
            $table->foreignId('id_user');
            $table->integer('izin')->default('2');
            $table->foreignId('port_id');
            // $table->foreignId('id_port')->constrained('olt_ports')->onDelete('cascade');
            // $table->foreignId('id_user')->constrained('users')->onDelete('cascade');;
            $table->enum('jenisPembangunan', ['PT 2', 'PT 3']);
            $table->string('labelODP');
            $table->string('labelODC');
            $table->string('distribusi');
            $table->string('alamat');
            $table->integer('port');
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
        Schema::dropIfExists('pengajuans');
    }
}
