@extends('layout.dashboard')
@section('title')
    {{ __('page.workplaces.edit')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <div class="page-title">
                    <h3>{{ __('page.workplaces.edit')}} - {{ $workplace->name }}</h3>
                </div>
                <form method="POST" action="{{ route("workplaces.update", $workplace->uuid) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="name"
                                type="text"
                                id="name"
                                required
                                label="{{ __('attributes.user.name') }}"
                                placeholder="{{ __('attributes.user.name') }}"
                                class="form-control-muted"
                                value="{{ $workplace->name }}"
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="address"
                                type="text"
                                id="address"
                                label="{{ __('attributes.user.address') }}"
                                placeholder="{{ __('attributes.user.address') }}"
                                class="form-control-muted"
                                value="{{ $workplace->address }}"
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="zip"
                                type="text"
                                id="zip"
                                label="{{ __('attributes.user.zip') }}"
                                placeholder="{{ __('attributes.user.zip') }}"
                                class="form-control-muted"
                                value="{{ $workplace->zip }}"
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="city"
                                type="text"
                                id="city"
                                label="{{ __('attributes.user.city') }}"
                                placeholder="{{ __('attributes.user.city') }}"
                                class="form-control-muted"
                                value="{{ $workplace->city }}"
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="number"
                                type="text"
                                id="number"
                                label="{{ __('attributes.workplaces.number') }}"
                                placeholder="{{ __('attributes.workplaces.number') }}"
                                class="form-control-muted"
                                value="{{ $workplace->number }}"
                            />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('common.update') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
