@extends('layout.dashboard')
@section('title')
    {{ __('page.employees.invite_employee')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <div class="page-title">
                    <h3>{{ __('page.employees.invite_employee')}}</h3>
                </div>
                <form method="POST" action="{{ route("employees.store") }}">
                    @csrf
                    @method('POST')
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="email"
                                type="email"
                                id="email"
                                required
                                label="{{ __('attributes.user.email') }}"
                                placeholder="{{ __('attributes.user.email') }}"
                                class="form-control-muted"
                                value="{{ old('email') }}"
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.select
                                name="role"
                                id="role"
                                required
                                label="{{ __('attributes.user.role') }}"
                                placeholder="{{ __('attributes.user.role') }}"
                                class="form-select form-control-muted"
                                :options="$roles"
                                value="{{ old('role') }}"
                            />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('common.invite') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
