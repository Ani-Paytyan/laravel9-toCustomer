@extends('layout.dashboard')
@section('title', __('page.employees.edit_employee'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ __('page.employees.edit_employee')}} : {{ $employee->getFullNameAttribute() }}</h4>
        </div>
        <form
            class="mb-0"
            method="POST"
            action="{{ route("employees.update", $employee->uuid) }}"
            x-data="{ loading: false }"
            @submit="loading = true"
        >
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <x-form.input
                            name="first_name"
                            type="text"
                            id="first_name"
                            required
                            label="{{ __('attributes.user.first_name') }}"
                            placeholder="{{ __('attributes.user.first_name') }}"
                            class="form-control-muted"
                            value="{{ old('first_name') ?? $employee->first_name }}"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-form.input
                            name="last_name"
                            type="text"
                            id="last_name"
                            required
                            label="{{ __('attributes.user.last_name') }}"
                            placeholder="{{ __('attributes.user.last_name') }}"
                            class="form-control-muted"
                            value="{{ old('last_name') ?? $employee->last_name }}"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-form.input
                            name="email"
                            type="email"
                            id="email"
                            label="{{ __('attributes.user.email') }}"
                            placeholder="{{ __('attributes.user.email') }}"
                            class="form-control-muted"
                            value="{{ old('email') ?? $employee->email }}"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-form.input
                            name="phone"
                            type="text"
                            id="phone"
                            label="{{ __('attributes.user.phone') }}"
                            placeholder="{{ __('attributes.user.phone') }}"
                            class="form-control-muted"
                            value="{{ old('phone') ?? $employee->phone }}"
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
                            value="{{ old('address') ?? $employee->address }}"
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
                            value="{{ old('city') ?? $employee->city }}"
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
                            value="{{ old('zip') ?? $employee->zip }}"
                        />
                    </div>
                    @if ($canEditRole)
                        <div class="col-md-6 mb-3">
                            <x-form.select
                                name="role"
                                id="role"
                                required
                                label="{{ __('attributes.user.role') }}"
                                placeholder="{{ __('attributes.user.role') }}"
                                class="form-control"
                                :options="$roles"
                                value="{{ old('role') ?? $employee->role }}"
                            />
                        </div>
                    @endif
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
    @include('employees.components.workplaces')
    @include('employees.components.unique-items')
    @include('employees.components.teams')
@endsection


