@extends('layouts.app')


@section('content')

    {{-- Header --}}
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section id="section-hero" aria-label="section" class="jarallax text-light">
            <img src="{{ asset('img/background/1.jpg') }}" class="jarallax-img" alt="">
            <div class="container">
                <div class="row">
                    <div class="spacer-double"></div>
                    <div class="col-lg-5 text-light">
                        <h2 class="mb-2 fs-1 text-bold">Mencari <span class="id-color">kendaraan</span>? Anda berada di
                            tempat yang tepat.</h2>
                        <div class="spacer-single"></div>
                    </div>
                </div>

                <div class="spacer-double"></div>

                <div class="row">
                    <div class="col-lg-12 text-light">
                        <div class="container-timeline">
                            <ul>
                                <li>
                                    <h4>Pilih kendaraan</h4>
                                    <p>
                                        Temukan petualangan tak tertandingi dan perjalanan tak terlupakan dengan armada kami
                                        yang luas kendaraan yang disesuaikan dengan setiap kebutuhan, selera, dan tujuan.
                                    </p>
                                </li>
                                <li>
                                    <h4>Pilih lokasi &amp; tanggal</h4>
                                    <p>
                                        Pilih lokasi dan tanggal ideal Anda, dan biarkan kami membawa Anda dalam perjalanan
                                        yang penuh dengan kenyamanan, fleksibilitas, dan pengalaman yang tak terlupakan.
                                    </p>
                                </li>
                                <li>
                                    <h4>Melakukan pemesanan</h4>
                                    <p>
                                        Amankan reservasi Anda dengan mudah, buka dunia yang penuh kemungkinan dan mulailah
                                        petualangan Anda berikutnya dengan percaya diri.
                                    </p>
                                </li>
                                <li>
                                    <h4>Duduk &amp; bersantai</h4>
                                    <p>
                                        Kenyamanan tanpa repot karena kami akan mengurus setiap detailnya, sehingga Anda
                                        dapat bersantai dan menikmati perjalanan yang penuh kenyamanan.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Cars --}}
    <section id="section-cars">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <span class="subtitle">Nikmati Perjalanan Anda</h2></span>
                    <h2>Armada Kendaraan Kami</h2>
                    <p>Wujudkan impian Anda dengan armada kendaraan serbaguna yang indah untuk perjalanan yang tak terlupakan.</p>
                    <div class="spacer-20"></div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row align-items-center">
                <div id="items-carousel-alt-2" class="owl-carousel wow fadeIn">
                    @forelse ($armadas as $armada)
                        @if ($armada->status == 0)
                            <div class="col-lg-12">
                                <div class="de-item alt-2 mb30">
                                    {{-- Mobil Photo --}}
                                    <div class="d-img">
                                        @if ($armada->mobilImages)
                                            <img src="{{ asset('storage/mobilImages/' . $armada->mobilImages) }}" alt="{{ $armada->mobilImages }}" class="img-fluid">
                                        @else
                                            <img src="{{ asset('img/car-default.png') }}" alt="Car Default" class="img-fluid">
                                        @endif
                                    </div>

                                    <div class="d-info">
                                        <div class="d-text">
                                            {{-- Nama Mobil --}}
                                            <h4>{{ $armada->nama_mobil }}</h4>

                                            <div class="d-atr-group">
                                                {{-- Plat Nomor --}}
                                                <span class="d-atr" style="font-size: 11px;">
                                                    <img src="https://www.madebydesignesia.com/themes/rentaly/images/icons/2-green.svg" alt="">
                                                    {{ $armada->plat_nomor }}
                                                </span>

                                                {{-- Bensin --}}
                                                <span class="d-atr" style="font-size: 11px;">
                                                    <img src="https://www.madebydesignesia.com/themes/rentaly/images/icons/3-green.svg" alt="">
                                                    {{ $armada->mobil->bensin }}
                                                </span>

                                                {{-- Type Mobil --}}
                                                <span class="d-atr" style="font-size: 11px;">
                                                    <img src="https://www.madebydesignesia.com/themes/rentaly/images/icons/4-green.svg" alt="">
                                                    {{ $armada->mobil->type_mobil }}
                                                </span>
                                            </div>

                                            {{-- Harga --}}
                                            <div class="d-price">
                                                Tarif harian mulai
                                                <span class="fs-4">Rp{{ number_format($armada->harga, 0, ',', '.') }}</span>
                                                <a class="btn-main" href="{{ route('transaksi.create', $armada->id) }}">Sewa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <h2 class="fw-bold">Mobil yang tersedia sudah habis atau belum tersedia.</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- About --}}
    <section class="text-light jarallax">
        <img src="{{ asset('img/background/2.jpg') }}" class="jarallax-img" alt="">

        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInRight">
                    <h2>Kami menawarkan kepada pelanggan berbagai macam mobil komersial dan mobil mewah untuk setiap kesempatan.</h2>
                </div>

                <div class="col-lg-6 wow fadeInLeft">
                    Di agen penyewaan mobil kami, kami percaya bahwa setiap orang berhak untuk merasakan kenikmatan
                    mengendarai kendaraan yang dapat diandalkan dan nyaman, berapa pun anggaran mereka. Kami telah
                    mengkurasi beragam armada mobil yang terawat dengan baik, mulai dari sedan yang ramping hingga SUV yang
                    luas, semuanya dengan harga yang kompetitif. Dengan proses penyewaan kami yang efisien, Anda dapat
                    dengan cepat dan mudah memesan kendaraan yang Anda inginkan. Apakah Anda membutuhkan transportasi untuk
                    perjalanan bisnis, liburan keluarga, atau hanya ingin menikmati liburan akhir pekan, kami memiliki
                    pilihan sewa yang fleksibel untuk mengakomodasi jadwal Anda.
                </div>
            </div>

            <div class="spacer-double"></div>

            <div class="row text-center">
                <div class="col-md-3 col-sm-6 mb-sm-30">
                    <div class="de_count transparent text-light wow fadeInUp" data-bgcolor="rgba(32, 32, 32, .5)">
                        <h3 class="timer" data-to="15425" data-speed="3000">0</h3>
                        Pesanan Selesai
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-sm-30">
                    <div class="de_count transparent text-light wow fadeInUp" data-bgcolor="rgba(32, 32, 32, .5)">
                        <h3 class="timer" data-to="8745" data-speed="3000">0</h3>
                        Pelanggan yang bahagia
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-sm-30">
                    <div class="de_count transparent text-light wow fadeInUp" data-bgcolor="rgba(32, 32, 32, .5)">
                        <h3 class="timer" data-to="235" data-speed="3000">0</h3>
                        Armada Kendaraan
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-sm-30">
                    <div class="de_count transparent text-light wow fadeInUp" data-bgcolor="rgba(32, 32, 32, .5)">
                        <h3 class="timer" data-to="15" data-speed="3000">0</h3>
                        Pengalaman bertahun-tahun
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section aria-label="section" class="no-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <span class="subtitle">Mengapa Memilih Kami</h2></span>
                    <h2>Fitur Kami</h2>
                    <p>Temukan dunia yang penuh dengan kenyamanan, keamanan, dan penyesuaian, membuka jalan untuk
                        petualangan yang tak terlupakan dan solusi mobilitas yang mulus.
                    </p>
                    <div class="spacer-20"></div>
                </div>

                <div class="clearfix"></div>

                <div class="col-lg-3">
                    <div class="box-icon s2 p-small mb20 wow fadeInRight" data-wow-delay=".5s">
                        <i class="fa bg-color fa-trophy"></i>
                        <div class="d-inner">
                            <h4>First class services</h4>
                            Di mana kemewahan berpadu dengan pelayanan yang luar biasa, menciptakan momen yang tak
                            terlupakan dan melampaui setiap ekspektasi Anda.
                        </div>
                    </div>

                    <div class="box-icon s2 p-small mb20 wow fadeInL fadeInRight" data-wow-delay=".75s">
                        <i class="fa bg-color fa-road"></i>
                        <div class="d-inner">
                            <h4>24/7 road assistance</h4>
                            Dukungan yang dapat diandalkan saat Anda sangat membutuhkannya, membuat Anda tetap beraktivitas
                            dengan percaya diri dan ketenangan pikiran.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <img src="{{ asset('img/car-default.png') }}" alt="Car Default" class="img-fluid wow fadeInUp">
                </div>

                <div class="col-lg-3">
                    <div class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft" data-wow-delay="1s">
                        <i class="fa bg-color fa-tag"></i>
                        <div class="d-inner">
                            <h4>Quality at Minimum Expense</h4>
                            Membuka kecemerlangan yang terjangkau dengan kualitas yang lebih tinggi sambil meminimalkan
                            biaya untuk mendapatkan hasil yang maksimal nilai.
                        </div>
                    </div>

                    <div class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft" data-wow-delay="1.25s">
                        <i class="fa bg-color fa-map-pin"></i>
                        <div class="d-inner">
                            <h4>Free Pick-Up & Drop-Off</h4>
                            Nikmati layanan penjemputan dan pengantaran gratis, menambahkan lapisan kemudahan ekstra pada
                            pengalaman penyewaan mobil Anda pengalaman Anda.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimoni --}}
    <section id="section-testimonials" class="no-top no-bottom">
        <div class="container">
            <div class="row g-4 align-items-center">
                {{-- Fiony Alveria Tantri --}}
                <div class="col-md-4 wow fadeInUp">
                    <div class="de-image-text">
                        <div class="d-text">
                            <div class="d-rating mb10">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>Excellent Service! Car Rent Service!</h4>
                            <div class="fs-5" style="color: #ffffffb8">
                                Saya telah menggunakan WheelsRent untuk kebutuhan Rental Mobil saya selama lebih dari 2
                                tahun. Saya tidak pernah memiliki masalah dengan layanan mereka. Dukungan pelanggan mereka
                                selalu responsif dan membantu. Luvvv WheelsRent💖💖💖💖💖.
                                <div class="by mt-4">~ Fiony Alveria Tantri ~</div>
                            </div>
                        </div>
                        <img src="{{ asset('img/testimoni/Fiony.jpeg') }}" class="img-fluid" alt="">
                    </div>
                </div>

                {{-- Flora Syafiqa Riyadi --}}
                <div class="col-md-4 wow fadeInUp">
                    <div class="spacer-double sm-hide"></div>
                    <div class="spacer-double sm-hide"></div>
                    <div class="de-image-text">
                        <div class="d-text">
                            <div class="d-rating mb10">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>Excellent Service! Car Rent Service!</h4>
                            <div class="fs-5" style="color: #ffffffb8">
                                Saat saya ke solo dan saya tidak membawa alat transportasi. Saya menemukan sebuah layanan
                                rental mobil bernama WheelsRent. Pelayanannya cepat dan mudah. Dan juga saya suka Octa yang
                                sudah bersedia menjadi supir saya💖💖
                                <div class="by mt-4">~ Flora Syafiqa Riyadi ~</div>
                            </div>
                        </div>
                        <img src="{{ asset('img/testimoni/Flora.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div>

                {{-- Freyanashifa Jayawardana --}}
                <div class="col-md-4 wow fadeInUp">
                    <div class="spacer-double sm-hide"></div>
                    <div class="spacer-double sm-hide"></div>
                    <div class="spacer-double sm-hide"></div>
                    <div class="spacer-double sm-hide"></div>
                    <div class="de-image-text">
                        <div class="d-text">
                            <div class="d-rating mb10">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>Excellent Service! Car Rent Service!</h4>
                            <div class="fs-5" style="color: #ffffffb8">
                                Didukung oleh para ahli industri, WheelsRent adalah solusi Rental Mobil yang dapat Anda
                                percayai. Dengan pengalaman bertahun-tahun di bidangnya, kami menyediakan layanan Rental
                                Mobil yang cepat, andal, dan aman.
                                <div class="by mt-4">~ Freyanashifa Jayawardana ~</div>
                            </div>
                        </div>
                        <img src="{{ asset('img/testimoni/Freya.jpeg') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- News --}}
    <section id="section-news">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <span class="subtitle">Terbaru Dari Kami</h2></span>
                    <h2>News &amp; Promo</h2>
                    <p>Berita terkini, perspektif baru, dan liputan mendalam - tetaplah menjadi yang terdepan dengan berita,
                        wawasan, dan analisis terbaru kami.</p>
                    <div class="spacer-20"></div>
                </div>

                <div class="col-lg-4 mb10">
                    <div class="bloglist s2 item">
                        <div class="post-content">
                            <div class="post-image">
                                <div class="date-box">
                                    <div class="m">10</div>
                                    <div class="d">MAR</div>
                                </div>
                                <img alt="" src="{{ asset('img/news/pic-blog-1.jpg') }}" class="lazy">
                            </div>
                            <div class="post-text">
                                <h4>
                                    <a href="#">Nikmati Pengalaman Perjalanan Terbaik<span></span></a>
                                </h4>
                                <p>
                                    Bepergian adalah pengalaman yang memperkaya yang memungkinkan kita untuk menjelajahi
                                    tujuan baru, membenamkan diri dalam budaya yang berbeda, dan menciptakan kenangan seumur
                                    hidup.
                                </p>
                                <a class="btn-line" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb10">
                    <div class="bloglist s2 item">
                        <div class="post-content">
                            <div class="post-image">
                                <div class="date-box">
                                    <div class="m">12</div>
                                    <div class="d">MAR</div>
                                </div>
                                <img alt="" src="{{ asset('img/news/pic-blog-2.jpg') }}" class="lazy">
                            </div>
                            <div class="post-text">
                                <h4>
                                    <a href="#">Masa Depan Penyewaan Mobil<span></span></a>
                                </h4>
                                <p>
                                    Seiring dengan perkembangan teknologi yang semakin pesat, industri penyewaan mobil siap
                                    untuk mengalami perubahan yang transformatif. Masa depan penyewaan mobil menjanjikan ...
                                </p>
                                <a class="btn-line" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb10">
                    <div class="bloglist s2 item">
                        <div class="post-content">
                            <div class="post-image">
                                <div class="date-box">
                                    <div class="m">14</div>
                                    <div class="d">MAR</div>
                                </div>
                                <img alt="" src="{{ asset('img/news/pic-blog-3.jpg') }}" class="lazy">
                            </div>
                            <div class="post-text">
                                <h4>
                                    <a href="#">Tips Liburan Untuk Backpacker<span></span></a>
                                </h4>
                                <p>
                                    Bagi para pencari petualangan dan pelancong dengan anggaran terbatas, backpacking
                                    menawarkan cara yang mendebarkan dan mendalam untuk menjelajahi dunia. Apakah Anda
                                    memulai ...
                                </p>
                                <a class="btn-line" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Achievement --}}
    <section class="text-light jarallax" aria-label="section">
        <img src="{{ asset('img/background/3.jpg') }}" alt="" class="jarallax-img">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h1>Biarkan Petualangan Anda Dimulai</h1>
                    <div class="spacer-20"></div>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-trophy de-icon mb20"></i>
                    <h4>First Class Services</h4>
                    <p>Di mana kemewahan berpadu dengan pelayanan yang luar biasa, menciptakan momen yang tak terlupakan dan melampaui setiap ekspektasi Anda.</p>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-road de-icon mb20"></i>
                    <h4>24/7 road assistance</h4>
                    <p>Dukungan yang dapat diandalkan saat Anda sangat membutuhkannya, membuat Anda tetap beraktivitas dengan percaya diri dan ketenangan pikiran.</p>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-map-pin de-icon mb20"></i>
                    <h4>Free Pick-Up & Drop-Off</h4>
                    <p>Nikmati layanan penjemputan dan pengantaran gratis, yang menambahkan lapisan kemudahan ekstra pada pengalaman penyewaan mobil Anda.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Question --}}
    <section id="section-faq">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2>Ada Pertanyaan?</h2>
                    <div class="spacer-20"></div>
                </div>
            </div>

            <div class="row g-custom-x">
                <div class="col-md-6 wow fadeInUp">
                    <div class="accordion secondary">
                        <div class="accordion-section">
                            <div class="accordion-section-title" data-tab="#accordion-1">Bagaimana cara memulai dengan Rental Mobil?</div>
                            <div class="accordion-section-content" id="accordion-1">
                                <p>
                                    Untuk memulai dengan rental mobil, Anda perlu mencari perusahaan rental mobil yang
                                    terpercaya. Kemudian, Anda dapat melakukan pemesanan melalui situs web mereka,
                                    menghubungi langsung, atau datang ke kantor mereka. Pastikan Anda memiliki semua
                                    persyaratan yang diperlukan seperti SIM, kartu identitas, dan dokumen lainnya yang
                                    mungkin dibutuhkan.
                                </p>
                            </div>

                            <div class="accordion-section-title" data-tab="#accordion-2">Dapatkah saya menyewa mobil dengan kartu debit?</div>
                            <div class="accordion-section-content" id="accordion-2">
                                <p>
                                    Kebijakan setiap perusahaan rental mobil berbeda-beda. Beberapa perusahaan mungkin
                                    mengizinkan Anda untuk menyewa mobil dengan kartu debit, tetapi banyak juga yang
                                    memerlukan kartu kredit sebagai metode pembayaran. Sebaiknya Anda mengecek kebijakan
                                    perusahaan rental mobil terlebih dahulu.
                                </p>
                            </div>

                            <div class="accordion-section-title" data-tab="#accordion-3">Jenis Sewa Mobil apa yang saya butuhkan?</div>
                            <div class="accordion-section-content" id="accordion-3">
                                <p>
                                    Jenis sewa mobil yang Anda butuhkan tergantung pada kebutuhan perjalanan Anda. Jika Anda
                                    bepergian sendirian atau bersama pasangan, mobil kecil mungkin sudah cukup. Namun, jika
                                    Anda berpergian dengan keluarga atau dalam kelompok besar, Anda mungkin membutuhkan
                                    mobil yang lebih besar atau kendaraan khusus seperti van atau SUV.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 wow fadeInUp">
                    <div class="accordion secondary">
                        <div class="accordion-section">
                            <div class="accordion-section-title" data-tab="#accordion-b-4">Apa yang dimaksud dengan uang jaminan mobil sewaan?</div>
                            <div class="accordion-section-content" id="accordion-b-4">
                                <p>
                                    Uang jaminan adalah sejumlah uang yang Anda bayarkan kepada perusahaan rental mobil
                                    sebagai jaminan atas penyewaan mobil. Jumlah uang jaminan ini akan bervariasi tergantung
                                    pada jenis mobil dan kebijakan perusahaan. Uang jaminan ini akan dikembalikan kepada
                                    Anda setelah mobil dikembalikan dalam kondisi yang sama seperti saat disewa.
                                </p>
                            </div>
                        
                            <div class="accordion-section-title" data-tab="#accordion-b-5">Dapatkah saya membatalkan atau mengubah reservasi saya?</div>
                            <div class="accordion-section-content" id="accordion-b-5">
                                <p>
                                    Sebagian besar perusahaan rental mobil memiliki kebijakan pembatalan dan perubahan
                                    reservasi. Namun, kebijakan ini berbeda-beda antara perusahaan. Pastikan untuk membaca
                                    syarat dan ketentuan dengan cermat sebelum melakukan reservasi. Biasanya, Anda dapat
                                    membatalkan atau mengubah reservasi dengan waktu yang cukup, tetapi mungkin akan
                                    dikenakan biaya tambahan.
                                </p>
                            </div>

                            <div class="accordion-section-title" data-tab="#accordion-b-6">Apakah saya dapat memperpanjang masa sewa saya?</div>
                            <div class="accordion-section-content" id="accordion-b-6">
                                <p>
                                    Ya, Anda biasanya dapat memperpanjang masa sewa mobil Anda jika Anda memerlukannya lebih
                                    lama dari yang telah Anda rencanakan. Namun, pastikan untuk menghubungi perusahaan
                                    rental mobil dengan waktu yang cukup agar mereka dapat mengatur perpanjangan tersebut.
                                    Biaya perpanjangan akan berbeda tergantung pada perusahaan dan lama perpanjangan yang
                                    Anda minta.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Endorse --}}
    <section aria-label="section" class="pt40 pb40 text-light" data-bgcolor="#111111">
        <div class="wow fadeInRight d-flex">
            <div class="de-marquee-list">
                <div class="d-item">
                    <span class="d-item-txt">SUV</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Hatchback</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Crossover</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Convertible</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Sedan</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Sports Car</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Coupe</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Minivan</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Station Wagon</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Truck</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Minivans</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Exotic Cars</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>
                </div>
            </div>

            <div class="de-marquee-list">
                <div class="d-item">
                    <span class="d-item-txt">SUV</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Hatchback</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Crossover</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Convertible</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Sedan</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Sports Car</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Coupe</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Minivan</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Station Wagon</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Truck</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Minivans</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>

                    <span class="d-item-txt">Exotic Cars</span>
                    <span class="d-item-display">
                        <i class="d-item-dot"></i>
                    </span>
                </div>
            </div>
        </div>
    </section>

@endsection
