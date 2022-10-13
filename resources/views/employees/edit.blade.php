@extends('layout.dashboard')
@section('title')
    {{ __('page.employees.edit_employee')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <form method="POST" action="{{ route("employees.update", $id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="first_name"
                                type="text"
                                id="first_name"
                                required
                                label="{{ __('attributes.user.first_name') }}"
                                placeholder="{{ __('attributes.user.first_name') }}"
                                class="form-control-muted"
                            />
                        </div>
                        <div class="col-md">
                            <x-form.input
                                name="last_name"
                                type="text"
                                id="last_name"
                                required
                                label="{{ __('attributes.user.last_name') }}"
                                placeholder="{{ __('attributes.user.last_name') }}"
                                class="form-control-muted"
                            />
                        </div>
                    </div>
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
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="phone"
                                type="text"
                                id="phone"
                                required
                                label="{{ __('attributes.user.phone') }}"
                                placeholder="{{ __('attributes.user.phone') }}"
                                class="form-control-muted"
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="address"
                                type="text"
                                id="address"
                                required
                                label="{{ __('attributes.user.address') }}"
                                placeholder="{{ __('attributes.user.address') }}"
                                class="form-control-muted"
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="city"
                                type="text"
                                id="city"
                                required
                                label="{{ __('attributes.user.city') }}"
                                placeholder="{{ __('attributes.user.city') }}"
                                class="form-control-muted"
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="zip"
                                type="text"
                                id="zip"
                                required
                                label="{{ __('attributes.user.zip') }}"
                                placeholder="{{ __('attributes.user.zip') }}"
                                class="form-control-muted"
                            />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('common.update') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection


