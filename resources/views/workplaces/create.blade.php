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

                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ trans('common.create') }}</button>
            </form>
        </div>
    </div>
</div>

@endsection
