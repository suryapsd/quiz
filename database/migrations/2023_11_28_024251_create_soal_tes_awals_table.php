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
        Schema::create('soal_tes_awals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_instansi')->unsigned()->nullable();
            $table->string('soal')->nullable();
            $table->string('jawaban_a')->nullable();
            $table->string('jawaban_b')->nullable();
            $table->string('jawaban_c')->nullable();
            $table->string('jawaban_d')->nullable();
            $table->enum("kunci_jawaban", ["A", "B", "C", "D"])->nullable();
            
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
        Schema::dropIfExists('soal_tes_awals');
    }
};
