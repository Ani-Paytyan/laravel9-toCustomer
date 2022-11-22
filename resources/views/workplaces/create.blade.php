@extends('layout.dashboard')
@section('title', __('page.workplaces.create'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ __('page.workplaces.create')}}</h4>
        </div>
        <form
            class="mb-0"
            method="POST"
            action="{{ route("workplaces.store") }}"
            x-data="{ loading: false }"
            @submit="loading = true"
        >
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="mb-3">
                    <x-form.input
                        name="name"
                        type="text"
                        id="name"
                        required
                        label="{{ __('attributes.user.name') }}"
                        placeholder="{{ __('attributes.user.name') }}"
                        class="form-control-muted"
                        value="{{ old('name')}}"
                    />
                </div>
                <div class="mb-3">
                    <x-form.input
                        name="address"
                        type="text"
                        id="address"
                        label="{{ __('attributes.user.address') }}"
                        placeholder="{{ __('attributes.user.address') }}"
                        class="form-control-muted"
                        value="{{ old('address')}}"
                    />
                </div>
                <div class="mb-3">
                    <x-form.input
                        name="zip"
                        type="text"
                        id="zip"
                        label="{{ __('attributes.user.zip') }}"
                        placeholder="{{ __('attributes.user.zip') }}"
                        class="form-control-muted"
                        value="{{ old('zip')}}"
                    />
                </div>
                <div class="mb-3">
                    <x-form.input
                        name="city"
                        type="text"
                        id="city"
                        label="{{ __('attributes.user.city') }}"
                        placeholder="{{ __('attributes.user.city') }}"
                        class="form-control-muted"
                        value="{{ old('city')}}"
                    />
                </div>
                <div>
                    <x-form.input
                        name="number"
                        type="text"
                        id="number"
                        label="{{ __('attributes.workplaces.number') }}"
                        placeholder="{{ __('attributes.workplaces.number') }}"
                        class="form-control-muted"
                        value="{{ old('number')}}"
                    />
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" :disabled="loading">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                    <x-heroicon-o-check x-show="!loading" />
                    {{ __('common.create') }}
                </button>
            </div>
        </form>
    </div>

@endsection
