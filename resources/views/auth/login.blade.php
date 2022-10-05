@extends('layout.auth')

@section('title', trans('page.login.title'))

@section('content')
    <div class="col-lg-10 col-md-9 col-xl-6 mx-auto ms-xl-0">
        <form method="post" action="{{ route('auth.login.store') }}">
            @csrf

            <div class="mb-5">
                <x-form.input
                    name="email"
                    type="email"
                    id="email"
                    label="{{ trans('attributes.user.email') }}"
                    class="form-control-muted"
                />
            </div>
            <div class="mb-5">
                <x-form.input
                    name="password"
                    type="password"
                    id="password"
                    label="{{ trans('attributes.user.password') }}"
                    class="form-control-muted"
                />
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-full">
                    {{ trans('page.login.sign_in_button') }}
                </button>
            </div>
        </form>
    </div>
@endsection