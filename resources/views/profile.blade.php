@extends('layouts.app')


@section('content')

    {{-- Toast --}}
    @if (session()->get('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div id="successToast" class="toast align-items-center text-white bg-success border-0 p-2" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session()->get('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="container" style="margin-top: 100px; padding-bottom: 100px;">
        <div class="row">
            {{-- Header --}}
            <div class="header"></div>

            <div class="card mb-3">
                {{-- Profile Edit --}}
                <div class="mt-2 d-flex justify-content-end btnn">
                    <a href="#" class="btn btn-large btn-success rounded-5" data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $user->id }}"><i class="bi bi-pencil"></i></a>
                </div>
                @include('includes.modal-editprofile')

                {{-- Profile Photo --}}
                <div class="profile d-flex justify-content-center">
                    @if ($user->images)
                        <img src="{{ asset('storage/images/' . $user->images) }}" class="rounded rounded-circle shadow" alt="{{ $user->images }}" style="object-fit: cover; width: 200px; height: 200px; border: 3px solid rgb(150, 150, 150);">
                    @else
                        <img src="{{ asset('img/user-profile-default.jpg') }}" class="rounded rounded-circle shadow" alt="User Image"  style="object-fit: cover; width: 200px; height: 200px; border: 3px solid rgb(150, 150, 150);">
                    @endif
                </div>

                {{-- Profile Detail --}}
                <div class="card-text pb-3">
                    <p class="fs-4 text-center card-text"><small class="text-muted">{{ $user->role }}</small></p>
                    <h1 class="card-text text-center"><b>{{ $user->name }}</b></h1>
                    <p class="card-text fs-2 text-center"><small class="text-muted">{{ $user->email }}</small></p>
                    <p class="card-text fs-4 text-muted mt-5">{{ $user->tanggal_lahir }} | {{ $user->jenis_kelamin }}</p>
                    <p class="card-text fs-3">{{ $user->alamat }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <script>
        // Periksa jika sesi memiliki 'success', tampilkan toast
        @if (session()->has('success'))
            // Menggunakan Toast dari Bootstrap 5
            var toastLiveExample = document.getElementById('successToast');
            var toast = new bootstrap.Toast(toastLiveExample);
            toast.show();
        @endif
    </script>

@endpush
