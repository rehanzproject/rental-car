@extends('dashboard.layouts.app')


@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        {{-- Create Supir --}}
                        <button class="btn btn-dark mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Supir</button>

                        {{-- Table Supir --}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table table-dark table-hover">
                                    <tr>
                                        <th>No</th>
                                        <th>Foto Supir</th>
                                        <th>Nama</th>
                                        <th>Usia</th>
                                        <th class="col-2">Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.supir.create')
    @foreach ($supirs as $supir)
        @include('dashboard.supir.edit')
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
                ajax: "{{ route('supir.list') }}",
                order: [],
                columns: [
                    { data: 'DT_RowIndex', sortable: false, searchable: false },
                    { data: 'supir_photo', sortable: false, searchable: false },
                    { data: 'nama' },
                    { data: 'usia' },
                    { data: 'jenis_kelamin' },
                    { data: 'alamat' },
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
