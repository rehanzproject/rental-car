<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">

                {{-- Dropdown Button --}}
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    @if (auth()->user()->images)
                        <img src="{{ asset('storage/images/' . auth()->user()->images) }}" alt="{{ auth()->user()->images }}" class="rounded rounded-circle mb-sm-1" style="object-fit: cover; width: 30px; height: 30px; border: 1px solid rgb(150, 150, 150);">
                    @else
                        <img src="{{ asset('img/user-profile-default.jpg') }}" alt="User Image" class="rounded rounded-circle mb-sm-1" style="object-fit: cover; width: 30px; height: 30px; border: 1px solid rgb(150, 150, 150);">
                    @endif
                    {{ auth()->user()->name }}
                </a>

                {{-- Dropdown Menu --}}
                <div class="dropdown-menu dropdown-menu-end animate-menu slideIn-menu" aria-labelledby="navbarDropdown">
                    {{-- Profile --}}
                    <a href="{{ route('dashboard.profile') }}" class="d-block text-dark text-decoration-none fw-bold fs-6">
                        <div class="card m-2 pt-2">
                            <div class="justify-content-center d-flex mb-2">
                                <div class="image">
                                    @if (auth()->user()->images)
                                        <img src="{{ asset('storage/images/' . auth()->user()->images) }}" alt="{{ auth()->user()->images }}" class="img-circle elevation-2" style="object-fit: cover; width: 40px; height: 40px; border: 1px solid rgb(150, 150, 150);">
                                    @else
                                        <img src="{{ asset('img/user-profile-default.jpg') }}" alt="User Image" class="img-circle elevation-2" style="object-fit: cover; width: 40px; height: 40px; border: 1px solid rgb(150, 150, 150);">
                                    @endif
                                </div>
                            </div>
                            <div class="info px-2">
                                <p class="text-center d-block text-dark text-decoration-none fw-bold fs-6">{{ auth()->user()->name }}</p>
                            </div>
                        </div>
                    </a>

                    {{-- Main Menu --}}
                    <a class="dropdown-item" href="{{ route('welcome') }}">Home</a>
                    <hr class="dropdown-divider">

                    {{-- Edit Profile --}}
                    <a class="dropdown-item" href="{{ route('dashboard.profile') }}">Edit Profile</a>
                    <hr class="dropdown-divider">

                    {{-- Logout --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>
