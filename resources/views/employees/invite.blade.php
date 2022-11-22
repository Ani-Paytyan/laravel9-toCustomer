@extends('layout.dashboard')
@section('title', __('page.employees.invite_employee'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ __('page.employees.invite_employee')}}</h4>
        </div>
        <form
            class="mb-0"
            method="POST"
            action="{{ route("employees.store") }}"
            x-data="{ loading: false }"
            @submit="loading = true"
        >
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="mb-3">
                    <x-form.input
                        name="email"
                        type="email"
                        id="email"
                        required
                        label="{{ __('attributes.user.email') }}"
                        placeholder="{{ __('attributes.user.email') }}"
                        class="form-control-muted"
                        value="{{ old('email') }}"
                    />
                </div>
                <div>
                    <x-form.select
                        name="role"
                        id="role"
                        required
                        label="{{ __('attributes.user.role') }}"
                        placeholder="{{ __('attributes.user.role') }}"
                        class="form-control"
                        :options="$roles"
                        value="{{ old('role') }}"
                    />
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" :disabled="loading">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                    <x-heroicon-o-paper-airplane x-show="!loading" />
                    {{ __('common.invite') }}
                </button>
            </div>
        </form>
    </div>
@endsection
