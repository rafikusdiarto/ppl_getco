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
        Schema::create('pemilik_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->date("date");
            $table->foreignId("bahan_baku_id")->constrained();
            $table->string("kebutuhan");
            $table->bigInteger("pengeluaran");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemilik_pengeluarans');
    }
};
