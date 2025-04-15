@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Gallery' => route('dashboard.gallery.index'),
        'Edit' => '#',
    ],
])
@section('title', 'Edit Gallery')
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4-5 px-4">
                    <div class="d-flex justify-content-end mb-4 gap-2">
                        <a href="{{ route('dashboard.gallery.update', $gallery->id) }}" class="btn btn-success btn-sm">
                            <i class="bi bi-list-ul"></i>
                            Detail
                        </a>
                        <x-form.delete :id="$gallery->id" :action="route('dashboard.gallery.destroy', $gallery->id)" :label="$gallery->nama" text="Hapus" />
                    </div>
                    <form action="{{ route('dashboard.gallery.update', $gallery->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-form.input type="file" name="foto" label="Foto" addon-label='<i class="bi bi-image-fill"></i>' :addon-link="asset('storage/' . $gallery->file_path)" />
                        <x-form.input name="deskripsi" label="Deskripsi" :value="$gallery->deskripsi" :required="true" />
                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush
