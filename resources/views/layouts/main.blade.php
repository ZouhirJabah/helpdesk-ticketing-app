<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing System - @yield('title')</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #e6e3db;
            height: 100vh;
            overflow: hidden;
            margin: 0;
        }

        .layout-wrapper {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background-color: #5a6853;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            padding: 20px;
            flex-shrink: 0;
        }

        .sidebar-logo img {
            max-height: 90px;
            width: 100%;
            object-fit: contain;
        }

        .sidebar-menu {
            flex-grow: 1;
            overflow-y: auto;
            padding: 0 20px 20px 20px;
        }

        .sidebar .nav-link {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 5px;
            border-radius: 0.375rem;
            transition: all 0.2s ease-in-out;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #6d7d64;
            color: #ffffff;
        }

        .sidebar hr {
            border-color: #6d7d64;
            opacity: 1;
            margin-top: 0;
        }

        .right-panel {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .navbar-custom {
            background-color: #5a6853;
            height: 70px;
            width: 100%;
            flex-shrink: 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            padding: 0 30px;
        }

        .navbar-custom .dropdown-toggle,
        .navbar-custom span,
        .navbar-custom i {
            color: #ffffff !important;
        }

        .content-area {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="layout-wrapper">
        <nav class="sidebar">
            <div class="sidebar-logo">
                <a href="@if (Auth::user()->role === 'admin') {{ route('admin.dashboard') }} @else {{ route('dashboard') }} @endif"
                    class="d-flex align-items-center justify-content-center text-decoration-none">
                    <img src="{{ asset('login-image.jpg') }}" alt="Logo" class="img-fluid">
                </a>
                <hr>
            </div>

            <div class="sidebar-menu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        @if (Auth::user()->role === 'admin')
                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                        @else
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        @endif
                    </li>
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
                                href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people me-2"></i> Employés
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}"
                            href="{{ route('tickets.index') }}">
                            <i class="bi bi-ticket-detailed me-2"></i> Tickets

                        </a>
                    </li>
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/departements*') ? 'active' : '' }}"
                                href="/">
                                <i class="bi bi-building me-2"></i> Départements
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <div class="right-panel">
            <div class="navbar-custom d-flex justify-content-end align-items-center px-4">
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none text-white" href="#" role="button"
                        id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill fs-4 me-2"></i>
                        <span>
                            Bonjour
                            @if (Auth::user()->gender === 'Male')
                                Mr
                            @elseif(Auth::user()->gender === 'Female')
                                Mme
                            @endif
                            : <strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong>
                        </span>
                        <i class="bi bi-chevron-down ms-2 fs-6"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser"
                        style="background-color: #465240;">
                        <li>
                            <a class="dropdown-item text-white" href="#"
                                onmouseover="this.style.backgroundColor='#5a6853'"
                                onmouseout="this.style.backgroundColor='transparent'">
                                <i class="bi bi-gear me-2"></i> Mes paramètres
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" style="border-color: rgba(255,255,255,0.2);">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-white fw-bold"
                                    onmouseover="this.style.backgroundColor='#5a6853'"
                                    onmouseout="this.style.backgroundColor='transparent'">
                                    <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <main class="content-area">
                @yield('content')
            </main>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
