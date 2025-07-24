<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengunjungsTable extends Migration
{
    public function up()
    {
        Schema::create('pengunjungs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('waktu_kedatangan');
            $table->integer('jumlah_pengunjung');
            $table->string('jenis_kendaraan');
            $table->integer('uli_25')->default(0);
            $table->integer('uli_5')->default(0);
            $table->integer('uli_10')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengunjungs');
    }
}
