@extends('layouts.app')


@section('content')

    <div class="no-bottom no-top zebra" id="content">
        <div id="top"></div>

        {{-- Header --}}
        <section id="subheader" class="jarallax text-light">
            <img src="{{ asset('img/background/car-header.jpg') }}" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Cars</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-cars">
            <div class="container">
                <div class="row">
                    {{-- Filter --}}
                    <div class="col-lg-2">
                        <form action="{{ route('filter') }}" method="GET">
                            {{-- Type Mobil --}}
                            <div class="item_filter_group">
                                <h4>Type Mobil</h4>
                                <div class="de_form">
                                    @foreach ($typemobils as $typemobil)
                                        <div class="de_checkbox">
                                            <input id="typemobil_{{ $typemobil->id }}" name="type_mobil[]" type="checkbox"
                                                value="{{ $typemobil->type_mobil }}"
                                                @if (is_array(request('type_mobil')) && in_array($typemobil->type_mobil, request('type_mobil'))) checked @endif>
                                            <label for="typemobil_{{ $typemobil->id }}">{{ $typemobil->type_mobil }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Bensin --}}
                            <div class="item_filter_group">
                                <h4>Bensin</h4>
                                <div class="de_form">
                                    <div class="de_checkbox">
                                        <input id="bensin_pertamax_turbo" name="bensin[]" type="checkbox" value="Pertamax Turbo" @if (is_array(request('bensin')) && in_array('Pertamax Turbo', request('bensin'))) checked @endif>
                                        <label for="bensin_pertamax_turbo">Pertamax Turbo</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input id="bensin_pertamax" name="bensin[]" type="checkbox" value="Pertamax" @if (is_array(request('bensin')) && in_array('Pertamax', request('bensin'))) checked @endif>
                                        <label for="bensin_pertamax">Pertamax</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input id="bensin_pertalite" name="bensin[]" type="checkbox" value="Pertalite" @if (is_array(request('bensin')) && in_array('Pertalite', request('bensin'))) checked @endif>
                                        <label for="bensin_pertalite">Pertalite</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input id="bensin_solar" name="bensin[]" type="checkbox" value="Solar" @if (is_array(request('bensin')) && in_array('Solar', request('bensin'))) checked @endif>
                                        <label for="bensin_solar">Solar</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Button --}}
                            <div class="row">
                                <div class="col-7">
                                    <button class="btn-main">Filter</button>
                                </div>
                                <div class="col-3">
                                    <a href="{{ route('mobil') }}" class="btn-main btn-sm px-2"><i class="bi bi-x-circle"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Armada Mobil --}}
                    <div class="col-lg-10">
                        @forelse ($armadas as $armada)
                            <div class="de-item-list mb30">
                                {{-- Mobil Photo --}}
                                <div class="d-img">
                                    @if ($armada->mobilImages)
                                        <img src="{{ asset('storage/mobilImages/' . $armada->mobilImages) }}" alt="{{ $armada->mobilImages }}" class="img-fluid">
                                    @else
                                        <img src="{{ asset('img/car-default.png') }}" alt="Car Default" class="img-fluid">
                                    @endif
                                </div>

                                {{-- Detail Mobil --}}
                                <div class="d-info">
                                    <div class="d-text">
                                        <h4>{{ $armada->nama_mobil }}</h4>

                                        <div class="d-atr-group">
                                            <ul class="d-atr">
                                                <li>
                                                    <span>Type :</span>
                                                    {{ $armada->mobil->type_mobil }}
                                                </li>
                                                <li>
                                                    <span>Nama :</span>
                                                    {{ $armada->nama_mobil }}
                                                </li>
                                                <li>
                                                    <span>Bensin :</span>
                                                    {{ $armada->mobil->bensin }}
                                                </li>
                                                <li>
                                                    <span>Harga :</span>
                                                    <span style="font-size: 11px">Rp{{ number_format($armada->harga, 0, ',', '.') }} / Hari</span>
                                                </li>
                                                <li>
                                                    <span>Plat :</span>
                                                    <span class="badge bg-secondary">{{ $armada->plat_nomor }}</span>
                                                </li>
                                                <li>
                                                    <span>Drive:</span>
                                                    4x4
                                                </li>
                                                <li>
                                                    <span>Doors:</span>
                                                    4
                                                </li>
                                                <li>
                                                    <span>Status :</span>
                                                    @if ($armada->status == 0)
                                                        <span class="badge bg-success">Tersedia</span>
                                                    @else
                                                        <span class="badge bg-danger">Disewa</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {{-- Harga --}}
                                <div class="d-price">
                                    Tarif harian mulai <span>Rp{{ number_format($armada->harga, 0, ',', '.') }}</span>
                                    @if ($armada->status == 0)
                                        <a class="btn-main" href="{{ route('transaksi.create', $armada->id) }}">Sewa Sekarang</a>
                                    @else
                                        <button class="btn-main bg-secondary" disabled>Sedang Disewa</button>
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @empty
                            <div class="de-item-list mb30">
                                <h2 class="fw-bold text-secondary text-center">Mobil yang tersedia sudah habis atau belum tersedia.</h2>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
