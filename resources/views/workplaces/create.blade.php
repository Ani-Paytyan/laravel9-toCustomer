@extends('layout.dashboard')
@section('title')
    {{ __('page.workplaces.create')}}
@endsection
@section('content')
<div class="container-fluid">
    @include('layout.partials.messages')
    <div class="card mb-7">
        <div class="row card-header align-items-center">
            <div class="page-title">
                <h3>{{ __('page.workplaces.create')}}</h3>
            </div>
            <form method="POST" action="{{ route("workplaces.store") }}">
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
                            value="{{ old('name')}}"
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
                            value="{{ old('address')}}"
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
                            value="{{ old('zip')}}"
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
                            value="{{ old('city')}}"
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
                            value="{{ old('number')}}"
                        />
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ trans('common.create') }}</button>
            </form>
        </div>
    </div>
</div>

@endsection
