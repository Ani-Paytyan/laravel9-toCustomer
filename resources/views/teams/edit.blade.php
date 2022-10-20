@extends('layout.dashboard')
@section('title')
    {{ __('page.teams.edit')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <div class="page-title">
                    <h3>{{ __('page.teams.edit')}} - {{ $team->name }}</h3>
                </div>
                <form method="POST" action="{{ route("teams.update", $team->uuid) }}">
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
                                value="{{ $team->name }}"
                            />
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <x-form.input
                                name="description"
                                type="text"
                                id="description"
                                label="{{ __('attributes.team.description') }}"
                                placeholder="{{ __('attributes.team.description') }}"
                                class="form-control-muted"
                                value="{{ $team->description }}"
                            />
                        </div>
                    </div>
                    @include('teams.components.teams')
                    <button type="submit" class="btn btn-success">{{ trans('common.update') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
