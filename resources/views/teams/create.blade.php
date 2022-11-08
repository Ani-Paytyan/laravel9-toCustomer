@extends('layout.dashboard')
@section('title')
    {{ __('page.teams.create')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <div class="page-title">
                    <h3>{{ __('page.teams.create')}}</h3>
                </div>
                <form method="POST" action="{{ route("teams.store") }}">
                    @csrf
                    @method('POST')
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
                                value="{{ old('name') }}"
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
                                value="{{ old('description') }}"
                            />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('common.create') }}</button>
                </form>
            </div>
        </div>
    </div>

@endsection
