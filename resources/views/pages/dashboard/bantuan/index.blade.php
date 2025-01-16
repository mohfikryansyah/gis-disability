@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Bantuan' => '#',
    ],
])
@section('title', 'Bantuan')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/extensions/simple-datatable-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/table-datatable.css') }}">
@endpush
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    @if (auth()->user()->isRelawan())
                        <a href="{{ route('dashboard.bantuan.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="ms-1">Tambah Bantuan</span>
                        </a>
                    @endif
                    @if (auth()->user()->isManager())
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cloud-download" viewBox="0 0 16 16">
                                <path
                                    d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383" />
                                <path
                                    d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z" />
                            </svg>
                            <span class="ms-1">Export Data</span>
                        </button>
                        <x-modal id="exportModal" title="Export Excel" form="export_bantuan" button="Export">
                            <form action="{{ route('export.pimpinan.bantuan') }}" method="post" id="export_bantuan">
                                @csrf
                                <x-form.select name="penyandang_id" label="Penyandang" :options="$penyandang->map(function ($penyandang) {
                                    return (object) ['label' => $penyandang->nama, 'value' => $penyandang->id];
                                })" />
                                <x-form.select name="district_id" label="Kecamatan" :options="$districts->map(function ($district) {
                                    return (object) [
                                        'label' => $district->name,
                                        'value' => $district->id,
                                    ];
                                })" />
                            </form>
                        </x-modal>
                    @endif
                </div>
                <div class="card-body py-4-5 table-responsive px-4">
                    <table class="table-striped table" id="tabel-tasks">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Penyandang</th>
                                <th>Status</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bantuan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->penyandang->nama }}</td>
                                    <td>
                                        <x-badge.bantuan-status :status="$item->status" />
                                    </td>
                                    <td>{{ $item->jenis }}</td>
                                    <td style="white-space: nowrap">
                                        <a href="{{ route('dashboard.bantuan.show', $item->uuid) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="bi bi-list-ul"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/extensions/simple-datatables.js') }}"></script>
    <script src="{{ asset('js/static/report.js') }}"></script>
@endpush
