@extends('dashboard.layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            {{-- Header --}}
            <div class="header"></div>

            <div class="card mb-3">
                {{-- Profile Edit --}}
                <div class="position-absolute mt-3 ms-3">
                    <a href="#" class="btn btn-large btn-success rounded-5" data-bs-toggle="modal" data-bs-target="#editModal{{ auth()->user()->id }}"><i class="bi bi-pencil"></i></a>
                </div>
                @include('includes.modal-editprofile')

                {{-- Profile Photo --}}
                <div class="profile d-flex justify-content-center">
                    @if (auth()->user()->images)
                        <img src="{{ asset('storage/images/' . auth()->user()->images) }}" alt="{{ auth()->user()->images }}" class="img-circle elevation-2" style="object-fit: cover; width: 200px; height: 200px; border: 5px white solid">
                    @else
                        <img src="{{ asset('img/user-profile-default.jpg') }}" alt="User Image" class="img-circle elevation-2" style="object-fit: cover; width: 200px; height: 200px; border: 5px white solid">
                    @endif
                </div>

                {{-- Profile Detail --}}
                <div class="card-text pb-3">
                    <h1 class="card-text text-center"><b>{{ auth()->user()->name }}</b></h1>
                    <p class="card-text fs-2 text-center"><small class="text-muted">{{ auth()->user()->email }}</small></p>
                    <p class="card-text fs-4 text-muted mt-5">{{ auth()->user()->tanggal_lahir }} | {{ auth()->user()->jenis_kelamin }}</p>
                    <p class="card-text fs-3">{{ auth()->user()->alamat }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
