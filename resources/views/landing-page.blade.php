<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Landing Page</title>
    {{-- <link rel="shortcut icon" href="{{ $setting->app_logo ? asset('storage/uploads/settings/' . $setting->app_logo) : asset('images/default/jejakode.svg') }}" type="image/x-icon"> --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600|bangers:400&display=swap" rel="stylesheet" />
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}"> --}}
    {{-- <style>
        .text-responsive {
            font-size: 2rem;
        }

        @media (min-width: 768px) {
            .text-responsive {
                font-size: 3rem;
            }
        }

        @media (min-width: 992px) {
            .text-responsive {
                font-size: 4rem;
            }
        }

        .text-slate-900 {
            color: rgb(39, 43, 48);
        }

        .bg-yellow-400 {
            background-color: rgb(255, 212, 102)
        }

        .text-md {
            font-size: 1.1em;
            color: rgb(129, 129, 129)
        }

        .login:hover {
            border: 1px;
            border-color: black;
        }
    </style> --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .font-bangers {
            font-family: 'Bangers';
        }

        .font-figtree {
            font-family: 'Figtree';
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span
                    class="self-center text-2xl whitespace-nowrap dark:text-white font-bangers italic">DisabilityCare</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#home"
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#fitur"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Fitur</a>
                    </li>
                    <li>
                        <a href="#manfaat"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Manfaat</a>
                    </li>
                    <li>
                        <a href="#persebaran"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Persebaran</a>
                    </li>
                    <li>
                        <a href="#kegiatan"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Kegiatan</a>
                    </li>
                    <li>
                        <a href="#galeri"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Galeri</a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ route('dashboard.index') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Dashboard</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('auth.login.index') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
                        </li>

                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="w-full bg-white md:py-20 py-10 md:px-0 px-5">
        <div class="grid md:grid-cols-2 gap-4 max-w-screen-xl mx-auto">
            <div class="space-y-5 flex flex-col justify-center">
                <div class="md:text-6xl text-5xl font-bold text-slate-800">
                    <h1 class="mb-4">
                        {{ $pengaturanAplikasi->judul_utama_baris_1 }}
                    </h1>
                    <h1 class=" pb-2 rounded-lg mt-2 bg-yellow-400 px-4 max-w-fit">
                        {{ $pengaturanAplikasi->judul_utama_baris_2 }}
                    </h1>
                    <h1>
                        {{ $pengaturanAplikasi->judul_utama_baris_3 }}
                    </h1>
                </div>
                <p class="mdtext-lg text-md text-gray-500">
                    DisabilityCare adalah platform yang memungkinkan relawan dan admin untuk melakukan pendataan
                    penyandang disabilitas, dilengkapi dengan pemetaan (GIS) untuk lokasi penyandang disabilitas
                    dan
                    pengelolaan bantuan kepada penyandang dari relawan di tiap-tiap lokasi tertentu.
                </p>
                {{-- <button type="button"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 max-w-fit">Secondary</button> --}}
                <div class="flex items-center gap-5">
                    <img src="{{ asset('images/logo-kg.png') }}" class="object-contain w-16 h-auto">
                    <img src="{{ asset('images/logo-s.png') }}" class="object-contain w-[5rem] -mt-3 h-auto">
                </div>

            </div>
            <div class="overflow-hidden rounded-lg flex flex-col justify-center">
                <img src="{{ asset('/storage/' . $pengaturanAplikasi->gambar_utama) }}"
                    class="rounded-lg mx-auto hover:scale-105 transition duration-300" alt="Gambar Illustrasi">
            </div>
        </div>
    </section>

    <section id="fitur" class="w-full bg-slate-900 py-10">
        <div class="max-w-screen-xl mx-auto text-gray-100 text-center space-y-10">
            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-96 h-1 my-8 bg-gray-200 border-0 rounded dark:bg-gray-700">
                <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 dark:bg-slate-900">
                    <h1 class="text-3xl font-bold ">Fitur Utama</h1>
                </div>
            </div>
            <div
                class="grid {{ $pengaturanAplikasi->judul_fitur_4 !== null && $pengaturanAplikasi->fitur_4 !== null ? 'md:grid-cols-4' : 'md:grid-cols-3' }} gap-5 max-w-screen-xl mx-auto md:px-0 px-5">
                <div class="bg-slate-700 space-y-4 p-4 rounded-lg hover:scale-105 transition duration-300">
                    <h1 class="text-2xl text-start font-medium text-yellow-300">
                        {{ $pengaturanAplikasi->judul_fitur_1 }}
                    </h1>
                    <p class="text-start text-md text-gray-300">{{ $pengaturanAplikasi->fitur_1 }}</p>
                </div>
                <div class="bg-slate-700 space-y-4 p-4 rounded-lg hover:scale-105 transition duration-300">
                    <h1 class="text-2xl text-start font-medium text-yellow-300">
                        {{ $pengaturanAplikasi->judul_fitur_2 }}
                    </h1>
                    <p class="text-start text-md text-gray-300">{{ $pengaturanAplikasi->fitur_2 }}</p>
                </div>
                <div class="bg-slate-700 space-y-4 p-4 rounded-lg hover:scale-105 transition duration-300">
                    <h1 class="text-2xl text-start font-medium text-yellow-300">
                        {{ $pengaturanAplikasi->judul_fitur_3 }}</h1>
                    <p class="text-start text-md text-gray-300">{{ $pengaturanAplikasi->fitur_3 }}</p>
                </div>
                @if ($pengaturanAplikasi->judul_fitur_4 !== null && $pengaturanAplikasi->fitur_4 !== null)
                    <div class="bg-slate-700 space-y-4 p-4 rounded-lg hover:scale-105 transition duration-300">
                        <h1 class="text-2xl text-start font-medium text-yellow-300">
                            {{ $pengaturanAplikasi->judul_fitur_4 }}</h1>
                        <p class="text-start text-md text-gray-300">{{ $pengaturanAplikasi->fitur_4 }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="manfaat" class="w-full md:py-16 py-10 md:px-0 px-5">
        <div class="max-w-screen-xl mx-auto">
            <h1 class="md:text-5xl text-4xl font-bold text-center md:leading-[3.75rem] text-slate-800">Dampak yang
                </br>
                Telah Kami Ciptakan</h1>
            <p class="text-xl max-w-lg mx-auto mt-8 text-gray-500 text-center leading-[2rem]">Melalui Kolaborasi dan
                Kepedulian, Kami Telah Membantu Ribuan Orang di Kota Gorontalo</p>
            <div class="grid md:grid-cols-3 max-w-screen-lg text-center gap-5 mx-auto mt-8">
                <div class="bg-transparent space-y-4 py-4 rounded-lg">
                    <h1 class="text-7xl font-medium text-yellow-400">{{ count($penyandang) }}</h1>
                    <p class="font-medium text-xl text-gray-600">Data Penyandang</p>
                </div>
                <div class="bg-transparent space-y-4 py-4 rounded-lg">
                    <h1 class="text-7xl font-medium text-yellow-400">{{ count($relawan) }}</h1>
                    <p class="font-medium text-xl text-gray-600">Data Relawan</p>
                </div>
                <div class="bg-transparent space-y-4 py-4 rounded-lg">
                    <h1 class="text-7xl font-medium text-yellow-400">{{ count($bantuan) }}</h1>
                    <p class="font-medium text-xl text-gray-600">Data Bantuan</p>
                </div>
            </div>
        </div>
    </section>



    <!--  SECTION TOTAL DATA --->
    {{-- <section class="w-full bg-slate-900 py-10">
        <div class="max-w-screen-lg mx-auto text-gray-100 text-center space-y-10">
            <h1 class="text-3xl font-bold">Lebih dari 1000 data tercatat di sistem kami!</h1>
            <div class="grid grid-cols-3 gap-10 max-w-screen-md mx-auto">
                <div class="bg-slate-700 space-y-4 py-4 rounded-lg">
                    <h1 class="text-7xl font-medium text-yellow-300">214</h1>
                    <p class="font-medium text-xl text-gray-100">Data Penyandang</p>
                </div>
                <div class="bg-slate-700 space-y-4 py-4 rounded-lg">
                    <h1 class="text-7xl font-medium text-yellow-300">124</h1>
                    <p class="font-medium text-xl text-gray-100">Data Relawan</p>
                </div>
                <div class="bg-slate-700 space-y-4 py-4 rounded-lg">
                    <h1 class="text-7xl font-medium text-yellow-300">345</h1>
                    <p class="font-medium text-xl text-gray-100">Data Penyandang</p>
                </div>
            </div>
        </div>
    </section> --}}

    <section id="persebaran" class="w-full md:py-16 py-10 md:px-0 px-5">
        <h1 class="md:text-5xl text-4xl font-bold max-w-screen-xl mx-auto md:leading-[3.75rem] text-slate-800 mb-5">
            Peta Persebaran </br> Penyandang Disabilitas</h1>
        <div class="max-w-screen-xl h-auto mx-auto rounded-xl border-2 overflow-hidden border-gray-300">
            <div class="grid md:grid-cols-2">
                <div class="bg-white flex flex-col justify-center h-[50vh] pr-4 pl-8">
                    <h1 class="text-2xl font-medium">Melihat Lokasi Penyandang Disabilitas</h1>
                    <h2 class="text-lg text-gray-500">Dengan peta interaktif, Anda dapat menjelajahi persebaran
                        penyandang disabilitas di berbagai wilayah. Data ini membantu mengidentifikasi lokasi yang
                        membutuhkan dukungan lebih, memastikan bantuan dapat diberikan secara tepat sasaran.</h2>
                    <div class="rounded-lg bg-gray-50 max-w-fit p-4 mt-3">
                        <h1 class="text-gray-800 font-medium mb-3 text-yellow-500" id="title">Kota Gorontalo</h1>
                        <h1 class="text-gray-800 font-medium" id="penyandang-count">Jumlah Penyandang :
                            {{ count($penyandang) }}</h1>
                        <h1 class="text-gray-800 font-medium" id="relawan-count">Jumlah Relawan :
                            {{ count($relawan) }}</h1>
                        <h1 class="text-gray-800 font-medium" id="layanan-count">Jumlah Layanan :
                            {{ count($layanan) }}</h1>
                    </div>
                </div>
                <div class="bg-gray-100 h-[50vh]">
                    {{-- <div class="h-full border-2 border-dotted border-blue-500 flex items-center justify-center"> --}}
                    <div id="map" style="height: 50vh"></div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </section>

    <section id="kegiatan" class="w-full md:py-20 py-10 relative md:px-0 px-5">
        <h1 class="md:text-5xl text-4xl font-bold max-w-screen-xl mx-auto md:leading-[3.75rem] text-slate-800 mb-5">
            Kegiatan</h1>

        <div class="md:bg-gray-50 md:h-[40vh] relative md:mt-60">
            @if ($kegiatans->isNotEmpty())
                <div
                    class="max-w-screen-xl w-full gap-5 md:absolute md:top-10 md:left-1/2 md:transform md:-translate-x-1/2 md:-translate-y-1/2 mx-auto grid md:grid-cols-4">
                    @foreach ($kegiatans as $k)
                        <x-card :src="asset('storage/public/documentations/' . $k->documentations->first()?->name)" :title="$k->name" :address="$k->location" />
                    @endforeach
                </div>
            @else
                <div
                    class="max-w-screen-xl border-2 border-gray-200 border-dotted rounded-xl h-[20rem] mx-auto md:absolute md:top-10 md:left-1/2 md:transform md:-translate-x-1/2 md:-translate-y-1/2 w-full flex items-center justify-center text-gray-400 text-2xl">
                    Tidak ada data kegiatan.</div>
            @endif
        </div>
    </section>

    <section id="galeri" class="w-full pb-20 md:px-0 px-5">
        <div class="mx-auto max-w-screen-xl">
            <h1
                class="md:text-5xl text-4xl font-bold max-w-screen-xl mx-auto md:leading-[3.75rem] text-slate-800 mb-5">
                Galeri
            </h1>
            @if ($galleries->isNotEmpty())
                <div class="grid grid-cols-3 gap-5">
                    @foreach ($galleries as $gallery)
                        <div class="relative rounded-lg overflow-hidden group">
                            <a href="{{ asset('storage/' . $gallery->file_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $gallery->file_path) }}"
                                    class="h-auto w-full hover:scale-105 transition duration-300 mx-auto rounded-lg"
                                    alt="Image">
                                <!-- Overlay -->
                                <div
                                    class="absolute inset-0 flex items-end bg-gradient-to-t from-black to-transparent opacity-0 md:group-hover:opacity-100 transition duration-300 p-4 text-white text-left">
                                    <p class="text-sm md:text-base">{{ $gallery->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="w-full py-20 border-2 border-gray-200 border-dotted rounded-xl flex justify-center items-center">
                    Tidak ada foto yang tersedia untuk ditampilkan.
                </div>
            @endif
        </div>
    </section>


    <footer class="bg-slate-900">
        <div class="max-w-screen-xl md:px-0 px-4 flex justify-between items-center py-3 mx-auto">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span
                    class="self-center text-2xl whitespace-nowrap dark:text-white font-bangers italic">DisabilityCare</span>
            </a>
            <p class="text-gray-100">Copyright © DisabilityCare</p>
        </div>
    </footer>


    {{-- <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/docs/images/carousel/carousel-1.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/docs/images/carousel/carousel-2.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/docs/images/carousel/carousel-3.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/docs/images/carousel/carousel-4.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/docs/images/carousel/carousel-5.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div> --}}


    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
    <script>
        const penyandang = @json($penyandang);
        const layanan = @json($layanan);
        const geoJsonPath = @json(asset('geojson/administrasi_kecamatan_kota_gorontalo_2.geojson'));
        const route = @json(route('dashboard.master.penyandang.show', 'uuid'));
        const infoContainerTitle = document.querySelector('#title');
        const penyandangCount = document.querySelector('#penyandang-count ');
        const relawanCount = document.querySelector('#relawan-count ');
        const layananCount = document.querySelector('#layanan-count ');
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
                            `Jumlah Relawan: <b>${selectedDistrict.layanan.length}</b>`;
                    });

                    layer.on('mouseout', function() {
                        this.setStyle(defaultOptions);
                        infoContainerTitle.innerHTML = 'Kota Gorontalo';
                        penyandangCount.innerHTML =
                            'Jumlah Penyandang: <b>{{ $penyandang->count() }}</b>';
                        layananCount.innerHTML = 'Jumlah Relawan: <b>{{ $layanan->count() }}</b>';
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
</body>

</html>
