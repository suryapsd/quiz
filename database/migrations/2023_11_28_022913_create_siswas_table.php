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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->bigInteger('id_sekolah')->unsigned()->nullable();
            $table->string('nama')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->enum("jenis_kelamin", ["Laki-laki", "Perempuan"])->nullable();
            
            $table->foreign("id_user")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("id_sekolah")->references("id")->on("sekolahs")->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
