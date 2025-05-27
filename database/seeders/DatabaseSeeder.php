<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PengaturanAplikasi;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(DistrictSeeder::class);

        PengaturanAplikasi::create([
            'judul_utama_baris_1' => 'Empowering',
            'judul_utama_baris_2' => 'DisabilityCare',
            'judul_utama_baris_3' => 'on Gorontalo City',
            'gambar_utama' => 'gambar-utama/gambar-utama.png',
            'fitur_1' => 'DisabilityCare menyediakan alat pendataan yang dirancang untuk mempermudah relawan dan admin dalam mencatat informasi penyandang disabilitas dengan antarmuka yang ramah pengguna.',
            'fitur_2' => 'Fitur GIS memungkinkan pemetaan lokasi penyandang disabilitas secara visual dan interaktif. Admin dan relawan dapat melihat data geografis yang relevan, seperti penyebaran individu dengan kebutuhan khusus di suatu wilayah tertentu.',
            'fitur_3' => 'Fitur ini mempermudah distribusi dan pemantauan bantuan, baik berupa barang maupun layanan, kepada penyandang disabilitas. Relawan dan admin dapat mengelola jenis bantuan, jadwal pengiriman, serta melacak status penerimaan.',
            'fitur_4' => 'Platform ini menghubungkan relawan di berbagai wilayah untuk bekerja sama dalam membantu penyandang disabilitas. Melalui DisabilityCare, relawan dapat berbagi informasi, berkoordinasi untuk kegiatan lapangan, dan memanfaatkan fitur komunikasi yang terintegrasi',
            'judul_fitur_1' => 'Pendataan Cepat',
            'judul_fitur_2' => 'Pemetaan GIS',
            'judul_fitur_3' => 'Pengelolaan Bantuan',
            'judul_fitur_4' => 'Kolaborasi Relawan',
        ]);
    }
}
