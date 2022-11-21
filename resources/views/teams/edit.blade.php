@extends('layout.dashboard')
@section('title', __('page.teams.edit'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="text-center text-md-left mb-0">{{ __('page.teams.edit') }}: {{ $team->name }}</h4>
        </div>
        <form
            class="mb-0"
            method="POST"
            action="{{ route("teams.update", $team->uuid) }}"
            x-data="{ loading: false }"
            @submit="loading = true"
        >
            @csrf
            @method('PUT')
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
                        value="{{ old('name') ?? $team->name }}"
                    />
                </div>
                <x-form.input
                    name="description"
                    type="text"
                    id="description"
                    label="{{ __('attributes.team.description') }}"
                    placeholder="{{ __('attributes.team.description') }}"
                    class="form-control-muted"
                    value="{{ old('description') ?? $team->description }}"
                />
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" :disabled="loading">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                    <x-heroicon-o-check x-show="!loading" />
                    {{ __('common.update') }}
                </button>
            </div>
        </form>
    </div>
    <div class="mt-4">
        @include('teams.components.team-contacts')
    </div>
    <div class="mt-4">
        @include('teams.components.team-contacts-form')
    </div>
@endsection
