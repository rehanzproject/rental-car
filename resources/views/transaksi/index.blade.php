@extends('layouts.app')


@push('styles')

    <style>
        ::-webkit-scrollbar {
            width: 0.01px;
            height: 0.01px;
        }

        .buktiTransfer img {
            transition: transform 0.3s ease;
        }

        .buktiTransfer img:hover {
            transform: scale(1.1);
        }
    </style>

@endpush


@section('content')

    {{-- Toast --}}
    @if (session()->get('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div id="successToast" class="toast align-items-center text-white bg-success border-0 p-2" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session()->get('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="container" style="margin-top: 100px; padding-bottom: 500px;">
        <div class="row justify-content-center">
            <h3 class="fw-bold mb-3">Semua Transaksi :</h3>

            <div class="table-responsive">
                <table class="table table-striped table-lg">
                    <thead class=" table-dark">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col">Mobil</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tipe Peminjaman</th>
                            <th scope="col">Supir</th>
                            <th scope="col">Lama Sewa</th>
                            <th scope="col">Tanggal Sewa</th>
                            <th scope="col">Harga</th>
                            <th scope="col" class="text-center">Bukti Transfer</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($transaksis as $transaksi)
                            @if (auth()->check() && auth()->user()->id == $transaksi->user_id)
                                <tr>
                                    <td class="text-center text-light text-opacity-50">{{ $loop->iteration }}</td>
                                    <td class="text-light text-opacity-50">{{ $transaksi->armada->mobil->type_mobil }}</td>
                                    <td class="text-light text-opacity-50">{{ $transaksi->nama }}</td>
                                    <td class="text-light text-opacity-50">{{ $transaksi->tipe_peminjaman == 0 ? 'Tanpa Supir' : 'Dengan Supir' }}</td>
                                    <td class="text-light text-opacity-50">{!! $transaksi->supir_id ? $transaksi->supir->nama : '<span class="ms-3">-</span>' !!}</td>
                                    <td class="text-light text-opacity-50">{{ $transaksi->waktu }} Hari</td>
                                    <td class="text-light text-opacity-50">{{ $transaksi->tanggal }}</td>
                                    <td class="text-light text-opacity-50">Rp{{ $transaksi->harga }}</td>
                                    <td class="text-light text-opacity-50">
                                        @if ($transaksi->bayar_id)
                                            <div class="d-flex justify-content-center">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#buktiTransferModal{{ $transaksi->id }}"
                                                    class="buktiTransfer">
                                                    <img src="{{ asset('storage/bukti_transfer/' . $transaksi->bayar->bukti_transfer) }}"
                                                        width="50" alt="">
                                                </a>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#buktiTransferModal{{ $transaksi->id }}"
                                                    class="buktiTransfer">
                                                    <img src="{{ asset('img/empty-bukti_transfer.jpg') }}" width="50"
                                                        alt="">
                                                </a>
                                            </div>
                                        @endif
                                        @include('includes.modal-bukti_transfer', $transaksi)
                                    </td>
                                    <td>{!! $transaksi->status == 0
                                        ? '<div class="text-center"><p class="p-2 px-3 badge bg-secondary">Belum Bayar</p></div>'
                                        : ($transaksi->status == 1
                                            ? '<div class="text-center"><p class="p-2 px-3 badge bg-warning">Belum Disetujui</p></div>'
                                            : ($transaksi->status == 2
                                                ? '<div class="text-center"><p class="p-2 px-3 badge bg-success">Sedang Beroperasi</p></div>'
                                                : ($transaksi->status == 3
                                                    ? '<div class="text-center"><p class="p-2 px-3 badge bg-primary">Selesai</p></div>'
                                                    : '<div class="text-center"><p class="p-2 px-3 badge bg-danger">Dibatalkan</p></div>'))) !!}
                                    </td>
                                    <td>
                                        {{-- Bayar --}}
                                        <a href="#"
                                            class="btn btn-sm btn-success rounded mb-1 @if ($transaksi->status != 0) disabled @endif"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editTransaksiModal{{ $transaksi->id }}">
                                            <i class="fa fa-money-bill-wave"></i>
                                        </a>
                                        @include('includes.modal-bayar', $transaksi)
                                        {{-- Cancel --}}
                                        <form action="{{ route('bayar.cancel', $transaksi) }}" method="POST"
                                            enctype="multipart/form-data" class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger rounded mb-1 @if ($transaksi->status != 0 && $transaksi->status != 1) disabled @endif">
                                                <i class="fa fa-ban"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-light text-opacity-50">Anda belum melakukan transaksi apapun.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <script>
        @if (session()->has('success'))
            var toastLiveExample = document.getElementById('successToast');
            var toast = new bootstrap.Toast(toastLiveExample);
            toast.show();
        @endif
    </script>

@endpush
