<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTukarUlisTable extends Migration
{
    public function up(): void
    {
        Schema::create('tukar_ulis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('uli_25')->default(0);
            $table->integer('uli_5')->default(0);
            $table->integer('uli_10')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tukar_ulis');
    }
}
