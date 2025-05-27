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
        Schema::create('pengaturan_aplikasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul_utama_baris_1', 18)->default('Empowering');
            $table->string('judul_utama_baris_2', 18)->default('DisabilityCare');
            $table->string('judul_utama_baris_3', 18)->default('on Gorontalo City');
            $table->string('gambar_utama')->default('gambar-utama/gambar-utama.png');
            $table->string('fitur_1', 255)->default('DisabilityCare menyediakan alat pendataan yang dirancang untuk mempermudah relawan dan admin dalam mencatat informasi penyandang disabilitas dengan antarmuka yang ramah pengguna.');
            $table->string('fitur_2', 255)->default('Fitur GIS memungkinkan pemetaan lokasi penyandang disabilitas secara visual dan interaktif. Admin dan relawan dapat melihat data geografis yang relevan, seperti penyebaran individu dengan kebutuhan khusus di suatu wilayah tertentu.');
            $table->string('fitur_3', 255)->default('Fitur ini mempermudah distribusi dan pemantauan bantuan, baik berupa barang maupun layanan, kepada penyandang disabilitas. Relawan dan admin dapat mengelola jenis bantuan, jadwal pengiriman, serta melacak status penerimaan.');
            $table->string('fitur_4', 300)->default('Platform ini menghubungkan relawan di berbagai wilayah untuk bekerja sama dalam membantu penyandang disabilitas. Melalui DisabilityCare, relawan dapat berbagi informasi, berkoordinasi untuk kegiatan lapangan, dan memanfaatkan fitur komunikasi yang terintegrasi')->nullable();
            $table->string('judul_fitur_1', 20)->default('Pendataan Cepat');
            $table->string('judul_fitur_2', 20)->default('Pemetaan GIS');
            $table->string('judul_fitur_3', 20)->default('Pengelolaan Bantuan');
            $table->string('judul_fitur_4', 20)->default('Kolaborasi Relawan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_aplikasis');
    }
};
