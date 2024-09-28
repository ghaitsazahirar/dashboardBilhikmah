@extends('layouts.main')

@section('container')
<main>
<!-- Carousel Video Section -->
<div class="row g-0 text-center">
    <div class="col-sm-6 col-md-8">
        <div class="container hero-vid px-0 pt-lg-5">
            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($artikel as $index => $item)
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}"
                                class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($artikel as $item)
                        @if($item->video)
                            <div class="carousel-item py-lg-4 {{ $loop->first ? 'active' : '' }}">
                                <div class="text-center justify-content-center d-flex align-items-center image-container">
                                    <a href="/artikel/{{ $item->judul_sub }}/{{ $item->id }}" class="stretched-link">
                                        <img src="https://img.youtube.com/vi/{{ $item->gambar }}/maxresdefault.jpg" alt="{{ $item->judul }}" class="centered-image">
                                        <div class="play-icon">
                                            <i class="fa-duotone fa-circle-play"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="carousel-caption d-sm-block p-0">
                                    <a href="/artikel/{{ $item->judul_sub }}/{{ $item->id }}"
                                       class="shadow-lg badge text-decoration-none link-light fw-normal fs-5 stretched-link"
                                       style="text-align: center; white-space: normal;">
                                        {!! $item->judul !!}
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="carousel-item py-lg-4 {{ $loop->first ? 'active' : '' }}">
                                <div class="text-center justify-content-center d-flex align-items-center image-container">
                                    <a href="/artikel/{{ $item->judul_sub }}/{{ $item->id }}" class="stretched-link">
                                        <img src="{{ asset('storage/gambar/' . $item->gambar) }}" alt="{{ $item->judul }}" class="centered-image">
                                        <div class="play-icon">
                                            <i class="fa-duotone fa-circle-play"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="carousel-caption d-sm-block p-0">
                                    <a href="/artikel/{{ $item->judul_sub }}/{{ $item->id }}"
                                       class="shadow-lg badge text-decoration-none link-light fw-normal fs-5 stretched-link"
                                       style="text-align: center; white-space: normal;">
                                        {!! $item->judul !!}
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button> -->
            </div>
        </div>
    </div>

<!-- Kolom Informasi -->
<div class="col-12 col-md-4 mb-4 info-box">
    <div class="d-flex flex-column justify-content-around h-100 card-info">
        <!-- Jadwal Sholat -->
        <div class="text-light text-light-sholat p-3 rounded text-center" style="background-image: url('/storage/gambar/card-info.png'); background-size: 437px 219px;">
            <h4>JADWAL SHOLAT TERDEKAT</h4>
            <h2>{{ strtoupper($judulSholat) }}</h2>
            <h1>{{ $jadwalSholat }}</h1>
            <p><i class="fas fa-map-marker-alt"></i> {{ $provinsi }}</p>
        </div>

        <!-- Al-Qur'an -->
        <div class="text-light text-light-quran p-3 rounded text-center position-relative" style="background-image: url('/storage/gambar/card-info.png'); background-size: 437px 219px;">
            <div class="text-content-quran">
                <h4>AL-QUR'AN</h4>
                <p><i class="fas fa-book-open"></i> Terakhir Dibaca</p>
                <h2>Al-Fatihah</h2>
                <p>Ayat No: 3</p>
        </div>
        <!-- Gambar Al-Qur'an -->
        <img src="/storage/gambar/alquran.png" alt="Al-Qur'an" class="alquran-img">
        </div>
    </div>
</div>

    <!-- Welcome Section -->
    <!-- <section class="text-center container">
        <div class="album p-3 bg-green-light mb-5" style="border-radius: 10px;">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light"><b>Selamat Datang di Bil Hikmah</b></h1>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Poster and Article Section -->
    <div class="container marketing">
        <div class="album p-3 bg-success mb-5" style="border-radius: 10px;">
            <div class="row">
                @foreach ($poster as $item)
                    <div class="col-lg-4 mb-0 pt-3 text-center">
                        <div class="thumbnail">
                            <a href="{{ asset('storage/gambar/' . $item->gambar) }}" data-lightbox="photos">
                                <img data-src="{{ asset('storage/gambar/' . $item->gambar) }}"
                                     class="bd-placeholder-img card-img-top rounded-circle lazyload" alt="{{ $item->judul }}"
                                     style="width: 200px; height: 200px;">
                            </a>
                        </div>
                        <p class="text-light mt-2">"{{ $item->judul }}"</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Article Features -->
        @foreach ($artikel as $key => $item)
            <div class="row featurette {{ $key % 2 == 0 ? 'bg-green-light' : '' }}" style="border-radius: 5px;">
                <div class="col-md-7 {{ $key % 2 != 0 ? 'order-md-2' : '' }}">
                    <h2 class="featurette-heading mt-2">{{ $item->judul }}</h2>
                    <p class="lead">{{ $item->kutipan }}</p>
                    <a class="btn btn-success mb-4" href="/artikel/{{ $item->id }}" data-bs-toggle="tooltip"
                       data-bs-placement="bottom" title="Lebih Lanjut">Lebih lanjut →</a>
                </div>
                <div class="col-md-5">
                    <div class="thumbnail">
                        <a href="{{ asset('storage/gambar/' . $item->gambar) }}">
                            <img data-src="{{ asset('storage/gambar/' . $item->gambar) }}"
                                 class="bd-placeholder-img card-img-top lazyload" alt="{{ $item->judul }}"
                                 style="width: 100%; height: auto;">
                        </a>
                    </div>
                </div>
            </div>
            <hr class="featurette-divider m-5">
        @endforeach
    </div>
</main>
