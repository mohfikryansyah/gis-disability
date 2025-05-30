@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Kegiatan' => route('dashboard.activity.index'),
        'Edit' => '#',
    ],
])
@section('title', 'Edit Kegiatan')
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4-5 px-4">
                    <div class="d-flex justify-content-end mb-4 gap-2">
                        <a href="{{ route('dashboard.activity.show', $activity->uuid) }}" class="btn btn-success btn-sm">
                            <i class="bi bi-list-ul"></i>
                            Detail
                        </a>
                        <x-form.delete :id="$activity->uuid" :action="route('dashboard.activity.destroy', $activity->uuid)" :label="$activity->nama" text="Hapus" />
                    </div>
                    <form action="{{ route('dashboard.activity.update', $activity->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-form.input name="name" label="Nama Kegiatan" :value="$activity->name" />
                        <x-form.input name="location" label="Lokasi" :value="$activity->location" />
                        <x-form.input type="date" name="tanggal" label="Tanggal" :value="$activity->tanggal" />
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
