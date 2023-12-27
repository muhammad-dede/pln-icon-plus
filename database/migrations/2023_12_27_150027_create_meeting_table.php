<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('unit')->nullable();
            $table->uuid('id_ruang_meeting')->index()->nullable();
            $table->date('tanggal_meeting')->nullable();
            $table->uuid('id_waktu_meeting')->index()->nullable();
            $table->double('jumlah_peserta')->default(0);
            $table->uuid('id_jenis_konsumsi')->index()->nullable();
            $table->uuid('id_user')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('id_ruang_meeting')->on('ruang_meeting')->references('id')->onDelete('set null');
            $table->foreign('id_waktu_meeting')->on('waktu_meeting')->references('id')->onDelete('set null');
            $table->foreign('id_jenis_konsumsi')->on('jenis_konsumsi')->references('id')->onDelete('set null');
            $table->foreign('id_user')->on('user')->references('id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting');
    }
};
