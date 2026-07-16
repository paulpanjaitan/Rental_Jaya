<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mobils', function (Blueprint $table) {
        $table->id();
        $table->string('merek');
        $table->string('model');
        $table->string('nopol'); // Nomor Polisi
        $table->integer('harga_per_hari');
        $table->string('status')->default('tersedia'); // tersedia / disewa
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
