@extends('layout.base')

@section('page')
    <div class="min-vh-100 p-3 mx-auto d-flex align-items-center justify-content-center">
        <div class="w-100" style="max-width: 560px;">
            <img
                class="d-block mb-3 mx-auto"
                src="{{ asset('icon.svg') }}"
                width="96"
                height="96"
                alt="{{ config('app.name') }}"
            >
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="px-3 py-2 px-md-4 py-md-3 px-lg-5 py-lg-4">
                        @if(isset($message))
                            <x-common.alert type="{{ $message->getType() }}" class="mb-4">
                                {{ $message->getMessage() }}
                            </x-common.alert>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
