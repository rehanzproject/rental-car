@extends('dashboard.layouts.app')


@push('styles')

    <style>
        .buktiTransfer img {
            transition: transform 0.3s ease;
        }

        .buktiTransfer img:hover {
            transform: scale(1.1);
        }
    </style>

@endpush


@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            {{-- Table Transaksi --}}
                            <thead class="table table-dark table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Mobil</th>
                                    <th>Plat Nomor</th>
                                    <th>Lama Sewa</th>
                                    <th>Harga</th>
                                    <th>Tanggal Sewa</th>
                                    <th class="text-center">Bukti Transfer</th>
                                    <th class="text-center">Status</th>
                                    <th width="10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($transaksis as $transaksi)
        @include('includes.modal-bukti_transfer')
    @endforeach

@endsection


@push('scripts')

    <script>
        let datatable;
        $(document).ready(function() {
            datatable = $('table').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'<'table-responsive'tr>>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                processing: true,
                serverSide: true,
                ajax: "{{ route('transaksi.belumSetujulist') }}",
                order: [],
                columns: [
                    { data: 'DT_RowIndex', sortable: false, searchable: false },
                    { data: 'nama' },
                    { data: 'armada' },
                    { data: 'plat_nomor' },
                    { data: 'waktu' },
                    { data: 'harga' },
                    { data: 'tanggal' },
                    { data: 'bukti_transfer' },
                    { data: 'status' },
                    { data: 'action', sortable: false },
                ],
            });
        });
    </script>

    {{-- Toast --}}
    <script>
        const successMessage = "{{ session()->get('success') }}";
        if (successMessage) {
            toastr.success(successMessage)
        }

        const errorMessage = "{{ session()->get('error') }}";
        if (errorMessage) {
            toastr.error(errorMessage)
        }
    </script>

@endpush
