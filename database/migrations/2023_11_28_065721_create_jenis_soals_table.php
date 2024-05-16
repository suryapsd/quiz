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
        Schema::create('jenis_soals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pendidikan_instansi')->unsigned()->nullable();
            $table->string('nama_jenis_soal')->nullable();
            $table->tinyInteger('jumlah_soal')->nullable();
            $table->string('keterangan')->nullable();
            
            $table->foreign("id_pendidikan_instansi")->references("id")->on("pendidikan_instansis")->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_soals');
    }
};
