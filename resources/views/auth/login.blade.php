@extends('layout.auth')

@section('title', trans('page.login.title'))

@section('content')
    <h1 class="mb-4">{{ trans('page.login.title') }}</h1>
    <form
        method="post"
        action="{{ route('auth.login.store') }}"
        x-data="{ loading: false }"
        @submit="loading = true"
    >
        @csrf
        <div class="mb-4">
            <x-form.input
                name="email"
                type="email"
                id="email"
                label="{{ trans('attributes.user.email') }}"
            />
        </div>
        <div class="mb-5">
            <x-form.input
                name="password"
                type="password"
                id="password"
                label="{{ trans('attributes.user.password') }}"
            />
        </div>
        <button type="submit" class="btn btn-primary" :disabled="loading">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
            {{ trans('page.login.sign_in_button') }}
        </button>
    </form>
@endsection
