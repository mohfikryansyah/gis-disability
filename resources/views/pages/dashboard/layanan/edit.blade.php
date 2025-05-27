@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Layanan' => route('dashboard.layanan.index'),
        'Tambah Data' => '#',
    ],
])
@section('title', 'Ubah Layanan')
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4-5 px-4">
                    <form action="{{ route('dashboard.layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <x-form.input type="text" name="nama" label="Nama Layanan" :value="$layanan->nama"/>
                        <x-form.select name="jenis" label="Jenis Disabilitas" :value="$layanan->jenis" :options="[
                            (object) [
                                'label' => 'Fasilitas Fisik dan Aksesibilitas',
                                'value' => 'Fasilitas Fisik dan Aksesibilitas',
                            ],
                            (object) [
                                'label' => 'Layanan Kesehatan',
                                'value' => 'Layanan Kesehatan',
                            ],
                            (object) [
                                'label' => 'Dukungan Sosial dan Ekonomi',
                                'value' => 'Dukungan Sosial dan Ekonomi',
                            ],
                            (object) [
                                'label' => 'Layanan Pendidikan',
                                'value' => 'Layanan Pendidikan',
                            ],
                        ]" />
                        <x-form.input type="text" name="kontak" label="Nomor HP" :value="$layanan->kontak" format="phone" maxlength="13" />
                        <x-form.input type="file" name="dokumentasi" label="Dokumentasi" />
                        <x-form.select name="district_id" label="Kecamatan" :options="$districts->map(function ($district) {
                            return (object) [
                                'label' => $district->name,
                                'value' => $district->id,
                            ];
                        })" />
                        <div class="mb-3">
                            <label class="form-label">Peta</label>
                            <div id="map" style="height: 280px"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <x-form.input type="text" name="latitude" :value="$layanan->latitude" label="Latitude" />
                            </div>
                            <div class="col-6">
                                <x-form.input type="text" name="longitude" :value="$layanan->longitude" label="Longitude" />
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/custom/format-phone.js') }}"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
    <script>
        const inputKecamatan = document.querySelector('#district_id');
        var map = L.map('map').setView([0.5400, 123.0600], 12);
        var marker = L.marker([0.5400, 123.0600]).addTo(map);
        const geoJsonPath = @json(asset('geojson/administrasi_kecamatan_kota_gorontalo_2.geojson'));
        let currentLayer = null;
        let geoJsonLayers = [];

        function findLayerByDistrictName(districtName) {
            return geoJsonLayers.find(layer => {
                if (layer.feature && layer.feature.properties) {
                    if (layer.feature.properties.NAMOBJ === districtName) {
                        return true;
                    }
                    if (layer.feature.properties.NAMOBJ.toLowerCase() === districtName.toLowerCase()) {
                        return true;
                    }
                    if (layer.feature.properties.NAMOBJ.toLowerCase().includes(districtName.toLowerCase()) ||
                        districtName.toLowerCase().includes(layer.feature.properties.NAMOBJ.toLowerCase())) {
                        return true;
                    }
                }
                return false;
            });
        }

        inputKecamatan.addEventListener('change', e => {
            const selectedOption = e.target.selectedOptions[0];
            const value = selectedOption.value;
            const text = selectedOption.textContent.trim();

            if (currentLayer) {
                currentLayer.setStyle({
                    fillOpacity: 0.3,
                    weight: 1
                });
                currentLayer = null;
            }

            if (value && text && text !== 'Pilih Kecamatan') {
                const foundLayer = findLayerByDistrictName(text);

                if (foundLayer) {
                    currentLayer = foundLayer;
                    currentLayer.setStyle({
                        fillOpacity: 0.5,
                        weight: 2
                    });
                    map.fitBounds(currentLayer.getBounds());
                }
            }
        });

        omnivore.geojson(geoJsonPath)
            .on('ready', function() {
                this.eachLayer(function(layer) {
                    geoJsonLayers.push(layer);
                    layer.setStyle({
                        fillOpacity: 0.3,
                        weight: 1
                    });
                });

                const selectedDistrict = inputKecamatan.selectedOptions[0];
                if (selectedDistrict && selectedDistrict.value && selectedDistrict.textContent.trim() !==
                    'Pilih Kecamatan') {
                    const event = new Event('change');
                    inputKecamatan.dispatchEvent(event);
                }
            })
            .on('error', function(e) {
                console.error('Error loading GeoJSON:', e);
            })
            .addTo(map);

        map.on('click', function(e) {
            if (currentLayer) {
                if (currentLayer.getBounds().contains(e.latlng)) {
                    var lat = e.latlng.lat.toFixed(6);
                    var lng = e.latlng.lng.toFixed(6);

                    document.querySelector('[name="latitude"]').value = lat;
                    document.querySelector('[name="longitude"]').value = lng;

                    marker.setLatLng(e.latlng);

                } else {
                    const districtName = currentLayer.feature?.properties?.NAMOBJ || 'kecamatan yang dipilih';
                    alert(`Titik berada di luar wilayah ${districtName}.`);
                }
            } else {
                const selectedOption = inputKecamatan.selectedOptions[0];
                if (!selectedOption || !selectedOption.value || selectedOption.textContent.trim() ===
                    'Pilih Kecamatan') {
                    alert('Pilih kecamatan terlebih dahulu.');
                } else {
                    alert('Kecamatan belum dimuat di peta. Silakan tunggu sebentar atau pilih ulang kecamatan.');
                }
            }
        });

        // Initialize map tiles and controls
        L.Control.geocoder().addTo(map);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 12,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    </script>
@endpush
