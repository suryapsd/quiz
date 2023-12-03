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
        Schema::create('pendidikan_instansis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_instansi')->unsigned()->nullable();
            $table->string('nama_pendidikan')->nullable();
            $table->string('min_tinggi_badan')->nullable();
            $table->string('min_nilai_tes_lanjutan')->nullable();
            
            $table->foreign("id_instansi")->references("id")->on("instansis")->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan_instansis');
    }
};
