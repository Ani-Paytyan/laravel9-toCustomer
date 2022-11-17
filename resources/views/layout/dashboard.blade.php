@extends('layout.base')

@section('page')
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-light border-bottom border-bottom-lg-0 border-end-lg"
             id="navbarVertical">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
                    <img src="https://preview.webpixels.io/web/img/logos/clever-primary.svg" alt="...">
                </a>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teams.index') }}">
                                <i class="bi bi-people"></i> {{ __('page.teams.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('workplaces.index') }}">
                                <i class="bi bi-person-workspace"></i> {{ __('page.workplaces.title')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employees.index') }}">
                                <i class="bi bi-people"></i> {{ __('page.employees.title')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('unique-items.index') }}">
                                <i class="bi bi-handbag"></i> {{ __('page.unique-items.title')}}
                            </a>
                        </li>
                    </ul>

                    <p class="version">{{ AppVersionHelper::getAppVersion() }}</p>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom py-2">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="userNavDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ \Illuminate\Support\Facades\Auth::user()->getFirstName() }}
                                    {{ \Illuminate\Support\Facades\Auth::user()->getLastName() }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="userNavDropdown">
                                    @if (Gate::allows('create-working-days'))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('company.workdays') }}">
                                                <i class="bi bi-calendar-date"></i> {{ __('page.company.workdays') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item" href="{{ route('auth.logout') }}">
                                            <i class="bi bi-box-arrow-right"></i> {{ trans('common.logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
@endsection
