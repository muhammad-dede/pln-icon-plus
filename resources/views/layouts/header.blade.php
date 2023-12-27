<div class="sticky-top">
    <header class="navbar navbar-expand-md navbar-light sticky-top d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="{{ route('home') }}" class="d-flex align-items-center" style="text-decoration: none;">
                    <img src="{{ asset('') }}logo.png" alt="logo" class="navbar-brand-image">
                </a>
            </div>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <img src="{{ Avatar::create(auth()->user()->nama)->toBase64() }}"
                            class="avatar avatar-sm rounded-circle" />
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->nama }}</div>
                            <div class="mt-1 small text-muted">
                                {{ auth()->user()->username }}
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">
                            Profil
                        </a>
                        <a href="#" class="dropdown-item">
                            Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                            onclick="event.preventDefault();document.getElementById('form_logout').submit();">
                            Logout
                        </a>
                        <form id="form_logout" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- Menu --}}
    <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar navbar-light">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">
                                <span class="nav-link-title">
                                    Home
                                </span>
                            </a>
                        </li>
                        @can('index-user')
                            <li class="nav-item {{ Request::is('user') || Request::is('user/*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    <span class="nav-link-title">
                                        User
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('index-ruang-meeting')
                            <li
                                class="nav-item {{ Request::is('ruang-meeting') || Request::is('ruang-meeting/*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('ruang-meeting.index') }}">
                                    <span class="nav-link-title">
                                        Ruang Meeting
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('index-waktu-meeting')
                            <li
                                class="nav-item {{ Request::is('waktu-meeting') || Request::is('waktu-meeting/*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('waktu-meeting.index') }}">
                                    <span class="nav-link-title">
                                        Waktu Meeting
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('index-jenis-konsumsi')
                            <li
                                class="nav-item {{ Request::is('jenis-konsumsi') || Request::is('jenis-konsumsi/*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('jenis-konsumsi.index') }}">
                                    <span class="nav-link-title">
                                        Jenis Konsumsi
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('index-meeting')
                            <li class="nav-item {{ Request::is('meeting') || Request::is('meeting/*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('meeting.index') }}">
                                    <span class="nav-link-title">
                                        Meeting
                                    </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
