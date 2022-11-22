@extends('layout.dashboard')
@section('title', __('page.workplaces.edit'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ __('page.workplaces.edit') }}: {{ $workplace->name }}</h4>
        </div>
        <form
            class="mb-0"
            method="POST"
            action="{{ route("workplaces.update", $workplace->uuid) }}"
            x-data="{ loading: false }"
            @submit="loading = true"
        >
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <x-form.input
                            name="name"
                            type="text"
                            id="name"
                            required
                            label="{{ __('attributes.user.name') }}"
                            placeholder="{{ __('attributes.user.name') }}"
                            class="form-control-muted"
                            value="{{ old('name') ?? $workplace->name }}"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-form.input
                            name="address"
                            type="text"
                            id="address"
                            label="{{ __('attributes.user.address') }}"
                            placeholder="{{ __('attributes.user.address') }}"
                            class="form-control-muted"
                            value="{{ old('address') ?? $workplace->address }}"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-form.input
                            name="zip"
                            type="text"
                            id="zip"
                            label="{{ __('attributes.user.zip') }}"
                            placeholder="{{ __('attributes.user.zip') }}"
                            class="form-control-muted"
                            value="{{ old('zip') ?? $workplace->zip }}"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-form.input
                            name="city"
                            type="text"
                            id="city"
                            label="{{ __('attributes.user.city') }}"
                            placeholder="{{ __('attributes.user.city') }}"
                            class="form-control-muted"
                            value="{{ old('city') ?? $workplace->city }}"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-form.input
                            name="number"
                            type="text"
                            id="number"
                            label="{{ __('attributes.workplaces.number') }}"
                            placeholder="{{ __('attributes.workplaces.number') }}"
                            class="form-control-muted"
                            value="{{ old('number') ?? $workplace->number }}"
                        />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" :disabled="loading">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                    <x-heroicon-o-check x-show="!loading" />
                    {{ __('common.update') }}
                </button>
            </div>
        </form>
    </div>
@endsection
