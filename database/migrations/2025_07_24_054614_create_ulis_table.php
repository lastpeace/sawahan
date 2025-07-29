<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('kategori', ['Uli Beredar', 'Uli Cadangan', 'Uli Kembali', 'Tukar Uli']);
            $table->decimal('uli_25', 12, 2)->default(0);
            $table->integer('kps_25')->default(0);
            $table->decimal('uli_5', 12, 2)->default(0);
            $table->integer('kps_5')->default(0);
            $table->decimal('uli_10', 12, 2)->default(0);
            $table->integer('kps_10')->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulis');
    }
};
