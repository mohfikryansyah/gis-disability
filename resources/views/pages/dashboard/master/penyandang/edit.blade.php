@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Penyandang' => route('dashboard.master.penyandang.index'),
        'Edit' => '#',
    ],
])
@section('title', 'Edit Penyandang')
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4-5 px-4">
                    <div class="d-flex justify-content-end mb-4 gap-2">
                        <a href="{{ route('dashboard.master.penyandang.show', $penyandang->uuid) }}"
                            class="btn btn-success btn-sm">
                            <i class="bi bi-list-ul"></i>
                            Detail
                        </a>
                        <x-form.delete :id="$penyandang->uuid" :action="route('dashboard.master.penyandang.destroy', $penyandang->uuid)" :label="$penyandang->nama" text="Hapus" />
                    </div>
                    <h5 class="mb-4">Form Penyandang</h5>
                    <form action="{{ route('dashboard.master.penyandang.update', $penyandang->uuid) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-5">
                            <h5>Personal</h5>
                            <x-form.input type="text" name="nama" label="Nama Penyandang" :value="$penyandang->nama" />
                            <x-form.input type="tel" name="no_induk_disabilitas" label="Nomor Induk Disabilitas"
                                :value="$penyandang->no_induk_disabilitas" maxlength="16" />
                            <x-form.input type="tel" name="nik" label="Nomor Induk Kependudukan" maxlength="16"
                                :value="$penyandang->nik" />
                            <x-form.input type="tel" name="no_kk" label="Nomor Kartu Keluarga" maxlength="16"
                                :value="$penyandang->no_kk" />
                            <x-form.select name="jenis_kelamin" label="Jenis Kelamin" :value="$penyandang->jenis_kelamin" :options="[
                                (object) [
                                    'label' => App\Constants\UserGender::MALE,
                                    'value' => App\Constants\UserGender::MALE,
                                ],
                                (object) [
                                    'label' => App\Constants\UserGender::FEMALE,
                                    'value' => App\Constants\UserGender::FEMALE,
                                ],
                            ]" />
                            <x-form.select name="masa_pendidikan" label="Sedang Masa Pendidikan" :value="$penyandang->masa_pendidikan"
                                :options="[
                                    (object) [
                                        'label' => 'Ya',
                                        'value' => 'Ya',
                                    ],
                                    (object) [
                                        'label' => 'Tidak',
                                        'value' => 'Tidak',
                                    ],
                                ]" />
                            <x-form.select name="pendidikan_terakhir" label="Pendidikan Terakhir" :value="$penyandang->pendidikan_terakhir"
                                :options="[
                                    (object) [
                                        'label' => 'Tidak Sekolah',
                                        'value' => 'Tidak Sekolah',
                                    ],
                                    (object) [
                                        'label' => 'SD',
                                        'value' => 'SD',
                                    ],
                                    (object) [
                                        'label' => 'SMP',
                                        'value' => 'SMP',
                                    ],
                                    (object) [
                                        'label' => 'SMA/SMK',
                                        'value' => 'SMA/SMK',
                                    ],
                                    (object) [
                                        'label' => 'Diploma (D1-D3)',
                                        'value' => 'Diploma (D1-D3)',
                                    ],
                                    (object) [
                                        'label' => 'Sarjana (S1)',
                                        'value' => 'Sarjana (S1)',
                                    ],
                                    (object) [
                                        'label' => 'Magister (S2)',
                                        'value' => 'Magister (S2)',
                                    ],
                                    (object) [
                                        'label' => 'Doktor (S3)',
                                        'value' => 'Doktor (S3)',
                                    ],
                                ]" />
                            <x-form.select name="status_pernikahan" label="Status Pernikahan" :value="$penyandang->status_pernikahan"
                                :options="[
                                    (object) [
                                        'label' => 'Belum Menikah',
                                        'value' => 'Belum Menikah',
                                    ],
                                    (object) [
                                        'label' => 'Sudah Menikah',
                                        'value' => 'Sudah Menikah',
                                    ],
                                ]" />
                            <x-form.input type="text" name="keterampilan" label="Keterampilan" :value="$penyandang->keterampilan" />
                            <x-form.input type="text" name="usaha" label="Usaha" :value="$penyandang->usaha" />
                        </div>
                        <div class="mb-5">
                            <h5>Kontak</h5>
                            <x-form.input type="text" name="kontak" label="Nomor HP" format="phone" maxlength="14"
                                :value="$penyandang->kontak" />
                            <x-form.textarea type="text" name="alamat" label="Alamat" :value="$penyandang->alamat" />
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
                                    <x-form.input type="text" name="latitude" label="Latitude" :value="$penyandang->latitude" />
                                </div>
                                <div class="col-6">
                                    <x-form.input type="text" name="longitude" label="Longitude" :value="$penyandang->longitude" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <h5>Disabilitas</h5>
                            <x-form.select name="jenis_disabilitas" label="Jenis Disabilitas" :value="$penyandang->jenis_disabilitas"
                                :options="[
                                    (object) [
                                        'label' => 'Disabilitas Fisik',
                                        'value' => 'Disabilitas Fisik',
                                    ],
                                    (object) [
                                        'label' => 'Disabilitas Intelektual',
                                        'value' => 'Disabilitas Intelektual',
                                    ],
                                    (object) [
                                        'label' => 'Disabilitas Mental',
                                        'value' => 'Disabilitas Mental',
                                    ],
                                    (object) [
                                        'label' => 'Disabilitas Sensorik',
                                        'value' => 'Disabilitas Sensorik',
                                    ],
                                    (object) [
                                        'label' => 'Disabilitas Ganda',
                                        'value' => 'Disabilitas Ganda',
                                    ],
                                ]" />
                            {{-- <x-form.input type="text" name="keterangan_meninggal" label="Keterangan Meninggal" :value="$penyandang->keterangan_meninggal" />
							<x-form.input type="text" name="keterangan_sembuh" label="Keterangan Sembuh" :value="$penyandang->keterangan_sembuh" /> --}}
                            <x-form.select name="keterangan" label="Keterangan" :value="$penyandang->keterangan" :options="[
                                (object) [
                                    'label' => 'Sembuh',
                                    'value' => 'Sembuh',
                                ],
                                (object) [
                                    'label' => 'Belum Sembuh',
                                    'value' => 'Belum Sembuh',
                                ],
                                (object) [
                                    'label' => 'Meninggal',
                                    'value' => 'Meninggal',
                                ],
                            ]" />
                        </div>
                        <div>
                            <h5>Upload</h5>
                            <x-form.input type="file" name="foto_diri" label="Foto Penyandang"
                                addon-label='<i class="bi bi-image-fill"></i>' :addon-link="asset('storage/foto_diri/' . $penyandang->foto_diri)" />
                            <x-form.input type="file" name="foto_ktp" label="Foto Kartu Tanda Penduduk"
                                addon-label='<i class="bi bi-image-fill"></i>' :addon-link="asset('storage/foto_ktp/' . $penyandang->foto_ktp)" />
                            <x-form.input type="file" name="foto_kk" label="Foto Kartu Keluarga"
                                addon-label='<i class="bi bi-image-fill"></i>' :addon-link="asset('storage/foto_kk/' . $penyandang->foto_kk)" />
                            <x-form.input type="file" name="foto_usaha" label="Foto Usaha"
                                addon-label='<i class="bi bi-image-fill"></i>' :addon-link="asset('storage/foto_usaha/' . $penyandang->foto_usaha)" />
                            <x-form.input type="file" name="foto_rumah" label="Foto Rumah"
                                addon-label='<i class="bi bi-image-fill"></i>' :addon-link="asset('storage/foto_rumah/' . $penyandang->foto_rumah)" />
                        </div>
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

            console.log('Selected district:', text);

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

        relawanSelect.addEventListener('change', function() {
            const relawanId = this.value;

            if (relawanId) {
                const selectedRelawan = relawanData.find(relawan => relawan.id == relawanId);

                if (selectedRelawan) {
                    const districtId = selectedRelawan.district_id;

                    Array.from(inputKecamatan.options).forEach(option => {
                        option.selected = (option.value == districtId);
                    });

                    const event = new Event('change');
                    inputKecamatan.dispatchEvent(event);
                }
            } else {
                inputKecamatan.selectedIndex = 0;

                if (currentLayer) {
                    currentLayer.setStyle({
                        fillOpacity: 0.3,
                        weight: 1
                    });
                    currentLayer = null;
                }
            }
        });

        omnivore.geojson(geoJsonPath)
            .on('ready', function() {
                console.log('GeoJSON loaded successfully');

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

        L.Control.geocoder().addTo(map);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 12,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    </script>
@endpush
