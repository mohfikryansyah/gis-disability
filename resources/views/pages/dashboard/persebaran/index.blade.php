@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Persebaran' => '#',
    ],
])
@section('title', 'Persebaran')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/extensions/simple-datatable-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/table-datatable.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #info-container {
            position: absolute;
            bottom: 2.5rem;
            left: 2rem;
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            z-index: 1000;
        }

        #info-container #title {
            font-weight: bold;
        }
    </style>
@endpush
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4-5 table-responsive px-4">
                    <div id="map" style="height: 90vh"></div>
                    <div id="info-container">
                        <span id="title">Kota Gorontalo</span>
                        <div id="penyandang-count">
                            Jumlah Penyandang:
                            <b>{{ $penyandang->count() }}</b>
                        </div>
                        <div id="relawan-count">
                            Jumlah Relawan:
                            <b>{{ $relawan->count() }}</b>
                        </div>
                        <div id="layanan-count">
                            Jumlah Layanan:
                            <b>{{ $layanan->count() }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4-5 table-responsive px-4">
                    <h5 class="mb-3">Daftar Penyandang Disabilitas</h5>
                    <form method="GET" action="{{ route('dashboard.persebaran.index') }}">
                        <div class="row align-items-center ">
                            <div class="col-md-4">
                                <x-form.select name="jenis_disabilitas" label="Jenis Disabilitas" :value="$jenisDisabilitas"
                                    :options="[
                                        (object) ['label' => 'Disabilitas Fisik', 'value' => 'Disabilitas Fisik'],
                                        (object) [
                                            'label' => 'Disabilitas Intelektual',
                                            'value' => 'Disabilitas Intelektual',
                                        ],
                                        (object) ['label' => 'Disabilitas Mental', 'value' => 'Disabilitas Mental'],
                                        (object) ['label' => 'Disabilitas Sensorik', 'value' => 'Disabilitas Sensorik'],
                                        (object) ['label' => 'Disabilitas Ganda', 'value' => 'Disabilitas Ganda'],
                                    ]" />
                            </div>
                            <div class="col-auto mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                            <div class="col-auto mt-3">
                                <a href="{{ route('dashboard.persebaran.index') }}"
                                    class="btn btn-outline-secondary {{ request('jenis_disabilitas') ? '' : 'd-none' }}">Reset</a>
                            </div>
                        </div>
                    </form>

                    <table class="table-striped table" id="tabel-tasks">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penyandang</th>
                                @if (auth()->user()->isAdmin())
                                    <th>Kecamatan</th>
                                @endif
                                <th>Jenis Disabilitas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyandang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    @if (auth()->user()->isAdmin())
                                        <td>{{ $item->district->name }}</td>
                                    @endif
                                    <td>{{ $item->jenis_disabilitas }}</td>
                                    <td style="white-space: nowrap">
                                        @if (auth()->user()->isRelawan())
                                            <a href="{{ route('dashboard.penyandang.show', $item->uuid) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="bi bi-list-ul"></i>
                                                Detail
                                            </a>
                                        @endif
                                        @if (auth()->user()->isAdmin())
                                            <a href="{{ route('dashboard.master.penyandang.show', $item->uuid) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="bi bi-list-ul"></i>
                                                Detail
                                            </a>
                                        @endif
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
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
    <script>
        const penyandang = @json($penyandang);
        const layanan = @json($layanan);
        const geoJsonPath = @json(asset('geojson/administrasi_kecamatan_kota_gorontalo_2.geojson'));
        let route;
        if ({{ auth()->user()->isRelawan() ? 'true' : 'false' }}) {
            route = @json(route('dashboard.penyandang.show', 'uuid'));
        } else {
            route = @json(route('dashboard.master.penyandang.show', 'uuid'));
        }
        const infoContainerTitle = document.querySelector('#info-container #title ');
        const penyandangCount = document.querySelector('#info-container #penyandang-count ');
        const relawanCount = document.querySelector('#info-container #relawan-count ');
        const layananCount = document.querySelector('#info-container #layanan-count ');
        const districts = @json($districts);

        const gorontaloBounds = L.latLngBounds(
            L.latLng(0.596443, 122.990913),
            L.latLng(0.477865, 123.102922)
        );

        const map = L.map('map', {
                maxBounds: gorontaloBounds,
                maxBoundsViscosity: 1.0
            })
            .setView([0.5400, 123.0600], 12);

        const customIcon = L.icon({
            iconUrl: `{{ asset('icons/penyandang_3.svg') }}`,
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        const customIconLayanan = (icon) => L.icon({
            iconUrl: icon ?? '{{ asset('icons/penyandang_3.svg') }}',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });


        layanan.forEach(e => {
            const latlng = [e.latitude, e.longitude]
            const gmapsUrl = `https://www.google.com/maps?q=${e.latitude},${e.longitude}`;
            const lihatDetailUrl = `{{ route('dashboard.layanan.show', ['layanan' => 'id']) }}`.replace(
                'id',
                e.id
            );

            const popupContent = `
            <div style="min-width:200px; font-family:sans-serif">
                <h2 style="font-size:1.1rem; margin-bottom:4px; font-weight:600;">${e.nama}</h2>
                <p style="margin:2px 0;"><strong>Jenis:</strong> ${e.jenis}</p>
                <p style="margin:2px 0;"><strong>Kontak:</strong> ${e.kontak}</p>
                <div style="display: flex; flex-direction: column; gap: 6px; margin-top: 8px;">
                <a href="${gmapsUrl}" target="_blank" 
                    style="display:inline-block; margin-top:6px; padding:6px 10px; background-color:#187f80; color:white; border-radius:6px; text-decoration:none; width: 100%; text-align: center;">
                    Lihat di Google Maps
                </a>
                <a href="${lihatDetailUrl}"
                style="background-color: #facc15; color: black; padding: 6px 10px; text-align: center; border-radius: 6px; text-decoration: none; font-weight: 500;">
                    🔍 Lihat Detail
                </a>
                </div>
            </div>
        `;

            let marker = L.marker(latlng, {
                icon: customIconLayanan(e.icon ? '{{ asset('/') }}' + e.icon : null)
            }).addTo(map);

            marker.bindPopup(popupContent);
        });

        penyandang.forEach(e => {
            const latlng = [e.latitude, e.longitude]
            let marker = L.marker(latlng, {
                icon: customIcon
            }).addTo(map);
            marker.bindPopup(`
				<div style="font-family: sans-serif; min-width: 220px;">
                    <div style="margin-bottom: 6px;">
                        <span style="color: #555;">Nama</span>
                        <div style="font-weight: 600; color: #222;">${e.nama}</div>
                    </div>
                    <div style="margin-bottom: 6px;">
                        <span style="color: #555;">Alamat</span>
                        <div style="font-weight: 600; color: #222;">${e.alamat}</div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 6px; margin-top: 8px;">
                        <a href="https://maps.google.com/maps?q=${e.latitude},${e.longitude}" target="_blank"
                        style="background-color: #187f80; color: white; padding: 6px 10px; text-align: center; border-radius: 6px; text-decoration: none;">
                            📍 Lihat di Google Maps
                        </a>
                        <a href="${route.replace("uuid", e.uuid)}"
                        style="background-color: #facc15; color: black; padding: 6px 10px; text-align: center; border-radius: 6px; text-decoration: none; font-weight: 500;">
                            🔍 Lihat Detail
                        </a>
                    </div>
                </div>

			`);
        });

        omnivore.geojson(geoJsonPath)
            .on('ready', function() {
                this.eachLayer(function(layer) {
                    const districtName = layer.feature.properties.NAMOBJ;
                    const selectedDistrict = districts.find(item => item.name == districtName);
                    const fillColor = selectedDistrict.penyandang.length > 20 ? 'red' : 'skyblue';
                    const defaultOptions = {
                        fillOpacity: 0.3,
                        fillColor: fillColor,
                        weight: 1
                    };


                    layer.setStyle(defaultOptions);

                    layer.on('mouseover', function(e) {
                        this.setStyle({
                            fillOpacity: 0.6,
                            weight: 2
                        });

                        const selectedDistrict = districts.find(item => item.name == districtName)

                        infoContainerTitle.innerHTML = districtName;
                        penyandangCount.innerHTML =
                            `Jumlah Penyandang: <b>${selectedDistrict.penyandang.length}</b>`;
                        relawanCount.innerHTML =
                            `Jumlah Relawan: <b>${selectedDistrict.relawan.length}</b>`;
                        layananCount.innerHTML =
                            `Jumlah Relawan: <b>${selectedDistrict.relawan.length}</b>`;
                    });

                    layer.on('mouseout', function() {
                        this.setStyle(defaultOptions);
                        infoContainerTitle.innerHTML = 'Kota Gorontalo';
                        penyandangCount.innerHTML =
                            'Jumlah Penyandang: <b>{{ $penyandang->count() }}</b>';
                        layananCount.innerHTML = 'Jumlah Layanan: <b>{{ $layanan->count() }}</b>';
                        relawanCount.innerHTML = 'Jumlah Relawan: <b>{{ $relawan->count() }}</b>';
                    });
                });
            })
            .addTo(map);

        L.Control.geocoder().addTo(map);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 12,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    </script>
@endpush
