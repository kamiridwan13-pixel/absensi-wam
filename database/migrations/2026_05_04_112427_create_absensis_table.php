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
        Schema::create('absensis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->date('tanggal');

    $table->enum('tipe', ['kantor', 'luar']);
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved');

    $table->time('jam_masuk')->nullable();
    $table->time('jam_pulang')->nullable();

    $table->integer('jam_kerja')->default(0);
    $table->enum('status_hadir', ['hadir', 'telat', 'alpha'])->default('hadir');

    $table->text('alasan')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
