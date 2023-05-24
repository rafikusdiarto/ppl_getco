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
        Schema::create('akun_premiums', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("no_rek");
            $table->date('tanggal_bayar');
            $table->date('expired_date');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_premiums');
    }
};
