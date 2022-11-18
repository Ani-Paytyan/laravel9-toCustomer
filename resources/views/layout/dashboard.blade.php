
@extends('layout.base')

@php
    $navList = [
        ['label' => __('page.dashboard.title'), 'route' => route('dashboard')],
        ['label' => __('page.teams.title'), 'route' => route('teams.index')],
        ['label' => __('page.workplaces.title'), 'route' => route('workplaces.index')],
        ['label' => __('page.employees.title'), 'route' => route('employees.index')],
        ['label' => __('page.unique-items.title'), 'route' => route('unique-items.index')],
    ];
@endphp

@section('page')
    <div class="min-vh-100 d-flex flex-column">
        <main class="flex-grow-1">
            <header class="header sticky-top px-3 shadow-sm d-flex align-items-center" x-data="header" x-cloak>
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('icon.svg') }}" width="48" height="48" alt="{{ config('app.name') }}">
                </a>
                <nav class="nav ml-xl-5 d-none d-xl-block">
                    <ul class="nav-list">
                        @foreach($navList as $navItem)
                            @if (!isset($navItem['condition']) || $navItem['condition'])
                                <li><a href="{{ $navItem['route'] }}">{{ $navItem['label'] }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
                <div class="ml-auto">
                    <x-language/>
                    @if (Gate::allows('create-working-days'))
                        <a
                            class="btn btn-square"
                            href="{{ route('company.workdays') }}"
                            title="{{ __('page.company.workdays') }}"
                        >
                            <x-heroicon-o-calendar-days />
                        </a>
                    @endif
                    <button type="button" class="btn btn-square d-none" @click="$store.darkMode.toggle()">
                        <x-heroicon-o-sun x-show="$store.darkMode.on" />
                        <x-heroicon-o-moon x-show="!$store.darkMode.on" />
                    </button>
                    <a
                        class="btn btn-square"
                        href="{{ route('dashboard') }}"
                        title="{{ auth()->user()->getFirstName() }} {{ auth()->user()->getLastName() }}"
                    >
                        <x-heroicon-o-user />
                    </a>
                    <a class="btn btn-square" href="{{ route('auth.logout') }}" title="{{ __('common.logout') }}">
                        <x-heroicon-o-arrow-right-on-rectangle />
                    </a>
                    <button type="button" class="btn btn-square d-xl-none" @click="toggleMobileNav">
                        <x-heroicon-o-x-mark x-bind="xMark" />
                        <x-heroicon-o-bars-3 x-bind="bars" />
                    </button>
                </div>
                <nav class="mobile-nav d-xl-none" x-bind="mobileNav">
                    <ul class="nav-list">
                        @foreach($navList as $navItem)
                            @if (!isset($navItem['condition']) || $navItem['condition'])
                                <li><a href="{{ $navItem['route'] }}">{{ $navItem['label'] }}</a></li>
                            @endif
                        @endforeach
                        <li><a href="#" data-bs-toggle="modal" data-bs-target=".supportModal">{{ __('page.support.title')}}</a></li>
                    </ul>
                </nav>
            </header>
            <div class="container py-3 py-lg-4">
                @yield('content')
            </div>
        </main>
        <footer class="flex-shrink-0">
            <small class="text-muted">{{ AppVersionHelper::getAppVersion() }}</small>
        </footer>
    </div>
@endsection
