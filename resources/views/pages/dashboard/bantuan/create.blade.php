@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Bantuan' => route('dashboard.bantuan.index'),
        'Tambah Data' => '#',
    ],
])
@section('title', 'Tambah Bantuan')
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4-5 px-4">
                    <form action="{{ route('dashboard.bantuan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-form.select name="penyandang_id" label="Penyandang" :options="$penyandang->map(function ($penyandang) {
                            return (object) ['label' => $penyandang->nama, 'value' => $penyandang->id];
                        })" />
                        <x-form.select name="jenis" label="Jenis Bantuan" :options="collect(config('constants.JENIS_BANTUAN'))->map(function ($item) {
                            return (object) ['label' => $item, 'value' => $item];
                        })" />
                        <x-form.input type="date" name="tanggal" label="Tanggal" id="tanggal" />
                        <x-form.textarea name="detail" label="Detail Bantuan" />
                        @if (auth()->user()->isRelawan())
                            <x-form.input type="file" name="bukti" label="Bukti / Dokumentasi" />
                        @endif
                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
