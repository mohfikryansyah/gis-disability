@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
    ],
])
@section('title', 'Edit Bantuan')
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4-5 px-4">
                    <h5 class="mb-4">Form Bantuan</h5>
                    <form action="{{ route('dashboard.pengaturan.aplikasi.update', $pengaturanAplikasi->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <x-form.input name="judul_utama_baris_1" label="Judul Utama Baris 1" :value="$pengaturanAplikasi->judul_utama_baris_1" />
                        <x-form.input name="judul_utama_baris_2" label="Judul Utama Baris 2" :value="$pengaturanAplikasi->judul_utama_baris_2" />
                        <x-form.input name="judul_utama_baris_3" label="Judul Utama Baris 3" :value="$pengaturanAplikasi->judul_utama_baris_3" />
                        <x-form.input name="judul_fitur_1" label="Judul Fitur 1" :value="$pengaturanAplikasi->judul_fitur_1" />
                        <x-form.textarea name="fitur_1" label="Deskripsi Fitur 1" :value="$pengaturanAplikasi->fitur_1" />
                        <x-form.input name="judul_fitur_2" label="Judul Fitur 2" :value="$pengaturanAplikasi->judul_fitur_2" />
                        <x-form.textarea name="fitur_2" label="Deskripsi Fitur 2" :value="$pengaturanAplikasi->fitur_2" />
                        <x-form.input name="judul_fitur_3" label="Judul Fitur 3" :value="$pengaturanAplikasi->judul_fitur_3" />
                        <x-form.textarea name="fitur_3" label="Deskripsi Fitur 3" :value="$pengaturanAplikasi->fitur_3" />
                        <x-form.input name="judul_fitur_4" label="Judul Fitur 4" :value="$pengaturanAplikasi->judul_fitur_4" />
                        <x-form.textarea name="fitur_4" label="Deskripsi Fitur 4" :value="$pengaturanAplikasi->fitur_4" />
                        <x-form.input type="file" name="gambar_utama" label="Gambar Utama" />
						<span>Gambar harus memiliki dimensi 970x544</span>
                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
    <script src="{{ asset('js/custom/format-phone.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        flatpickr("#tanggal", {
            locale: "id",
            dateFormat: "d/m/Y",
            altInput: true,
            altFormat: "d/m/Y"
        });
    </script>
@endpush
