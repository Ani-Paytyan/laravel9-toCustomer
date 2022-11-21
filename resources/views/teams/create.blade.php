@extends('layout.dashboard')
@section('title', __('page.teams.create'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="text-center text-md-left mb-0">{{ __('page.teams.create')}}</h4>
        </div>
        <form
            class="mb-0"
            method="POST"
            action="{{ route("teams.store") }}"
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
                        value="{{ old('name') }}"
                    />
                </div>
                <x-form.input
                    name="description"
                    type="text"
                    id="description"
                    label="{{ __('attributes.team.description') }}"
                    placeholder="{{ __('attributes.team.description') }}"
                    class="form-control-muted"
                    value="{{ old('description') }}"
                />
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
