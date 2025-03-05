<header class="transparent has-topbar">
    <div id="topbar" class="topbar-dark text-light">
        <div class="container">
            <div class="topbar-left xs-hide">
                <div class="topbar-widget">
                    <div class="topbar-widget"><a href="#"><i class="fa fa-phone"></i>+62 896 7035 2908</a></div>
                    <div class="topbar-widget"><a href="#"><i class="fa fa-envelope"></i>wheelsrent@gmail.com</a></div>
                    <div class="topbar-widget"><a href="#"><i class="fa fa-clock"></i>Mon - Fri 08.00 - 18.00</a></div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
                    <div class="de-flex-col">
                        <div class="de-flex-col">
                            <!-- logo -->
                            <div id="logo">
                                <a href="/">
                                    <img class="logo-1" src="{{ asset('img/Logo.png') }}" alt="">
                                    <img class="logo-2" src="{{ asset('img/Logo.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="de-flex-col header-col-mid">
                        <ul id="mainmenu">
                            <li>
                                <a class="menu-item {{ Request::is('/*') ? 'active text-glow rounded-3 fw-bold' : '' }}" href="{{ route('welcome') }}">Home</a>
                            </li>
                            <li>
                                <a class="menu-item {{ Request::is('mobil*') ? 'active text-glow rounded-3 fw-bold' : '' }}" href="{{ route('mobil') }}">Mobil</a>
                            </li>
                            <li>
                                <a class="menu-item {{ Request::is('transaksi*') ? 'active text-glow rounded-3 fw-bold' : '' }}" href="{{ route('transaksi') }}">Transaksi</a>
                            </li>
                            <li>
                                <a class="menu-item {{ Request::is('contact*') ? 'active text-glow rounded-3 fw-bold' : '' }}" href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <div class="de-flex-col">
                        <div class="menu_side_area">
                            @guest
                                <a href="/login" class="btn-main">Sign In</a>
                            @else
                                <li class="nav-item dropdown" style="z-index: 999">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        @if (auth()->user()->images)
                                            <img src="{{ asset('storage/images/' . auth()->user()->images) }}" alt="{{ auth()->user()->images }}" class="rounded rounded-circle me-1 shadow" style="object-fit: cover; width: 30px; height: 30px; border: 1px solid rgb(150, 150, 150);">
                                        @else
                                            <img src="{{ asset('img/user-profile-default.jpg') }}" alt="{{ auth()->user()->images }}" class="rounded rounded-circle me-1 shadow" style="object-fit: cover; width: 30px; height: 30px; border: 1px solid rgb(150, 150, 150);">
                                        @endif
                                        {{ auth()->user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark animate-menu slideIn-menu" aria-labelledby="navbarDropdown">
                                        {{-- Profile --}}
                                        <a href="{{ route('profile') }}" class="d-block text-dark text-decoration-none fw-bold fs-6">
                                            <div class="card bg-dark m-2 pt-2">
                                                <div class="justify-content-center d-flex mb-2">
                                                    <div class="image">
                                                        @if (auth()->user()->images)
                                                            <img src="{{ asset('storage/images/' . auth()->user()->images) }}" class="rounded rounded-circle" alt="User Image" style="object-fit: cover; width: 40px; height: 40px; border: 1px solid rgb(150, 150, 150);">
                                                        @else
                                                            <img src="{{ asset('img/user-profile-default.jpg') }}" class="rounded rounded-circle" alt="User Image" style="object-fit: cover; width: 40px; height: 40px; border: 1px solid rgb(150, 150, 150);">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="text-bold text-secondary text-center pb-2">{{ auth()->user()->name }}</div><div class="info px-2">
                                                    <p class="text-center d-block text-white text-decoration-none fw-bold fs-6">{{ Auth()->user()->name }}</p>
                                                </div>
                                            </div>
                                        </a>

                                        {{-- Dashboard --}}
                                        @if (auth()->user()->role != 'Member')
                                            <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>

                                            <hr class="dropdown-divider">
                                        @endif

                                        {{-- Edit Profile --}}
                                        <a class="dropdown-item" href="{{ route('profile') }}">Edit Profile</a>

                                        <hr class="dropdown-divider">

                                        {{-- Logout --}}
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest

                            <span id="menu-btn"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
