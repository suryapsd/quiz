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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_jenis_soal')->unsigned()->nullable();
            $table->text('soal')->nullable();
            $table->text('jawaban_a')->nullable();
            $table->text('jawaban_b')->nullable();
            $table->text('jawaban_c')->nullable();
            $table->text('jawaban_d')->nullable();
            $table->enum("kunci_jawaban", ["A", "B", "C", "D"])->nullable();
            
            $table->foreign("id_jenis_soal")->references("id")->on("jenis_soals")->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
