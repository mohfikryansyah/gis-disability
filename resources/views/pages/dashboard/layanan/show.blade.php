@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Layanan' => route('dashboard.layanan.index'),
        $layanan->jenis => null,
    ],
])
@section('title', 'Detail Layanan')
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4-5 px-4">
                    <div class="d-flex justify-content-end mb-4 gap-2">
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('dashboard.layanan.edit', $layanan->id) }}"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </a>
                            <x-form.delete :id="$layanan->id" :action="route('dashboard.layanan.destroy', $layanan->id)" :label="$layanan->nama" text="Hapus" />
                        @endif
                    </div>
                    <table class="table-striped table">
                        <tr>
                            <th>Nama Layanan</th>
                            <td>{{ $layanan->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td>{{ $layanan->jenis }}</td>
                        </tr>
                        <tr>
                            <th>Kontak</th>
                            <td>{{ $layanan->kontak }}</td>
                        </tr>
                        <tr>
                            <th>Dokumentasi</th>
                            <td>
                                @if ($layanan->dokumentasi)
                                    <a href="{{ asset('/storage/' . $layanan->dokumentasi) }}" target="_blank">
                                        <img src="{{ asset('/storage/' . $layanan->dokumentasi) }}" alt="Dokumentasi"
                                            class="w-100 border border-2" height="100" style="object-fit: cover;">
                                    </a>
                                @else
                                    <span class="text-danger">Tidak ada dokumentasi</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
