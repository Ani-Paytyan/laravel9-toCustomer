@extends('layout.dashboard')
@section('title')
    {{ __('employees.edit_employee')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <form method="POST" action="{{ route("employees.update", $id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input name="first_name"
                                       type="text"
                                       class="form-control"
                                       id="first_name"
                                       placeholder="{{ __('employees.first_name') }}">
                                <label for="first_name">{{ __('employees.first_name') }} <span class="req">*</span></label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input name="last_name"
                                       type="text"
                                       class="form-control"
                                       id="last_name"
                                       placeholder="{{ __('employees.last_name') }}">
                                <label for="last_name">{{ __('employees.last_name') }} <span class="req">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input name="email"
                                       type="email"
                                       class="form-control"
                                       id="email"
                                       placeholder="{{ __('employees.email') }}">
                                <label for="email">{{ __('employees.email') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input name="phone"
                                       type="text"
                                       class="form-control"
                                       id="phone"
                                       placeholder="{{ __('employees.phone') }}">
                                <label for="phone">{{ __('employees.phone') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input name="address"
                                       type="text"
                                       class="form-control"
                                       id="address"
                                       placeholder="{{ __('employees.address') }}">
                                <label for="address">{{ __('employees.address') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input name="city"
                                       type="text"
                                       class="form-control"
                                       id="city"
                                       placeholder="{{ __('employees.city') }}">
                                <label for="city">{{ __('employees.city') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input name="zip"
                                       type="text"
                                       class="form-control"
                                       id="zip"
                                       placeholder="{{ __('employees.zip') }}">
                                <label for="zip">{{ __('employees.zip') }}</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('employees.update') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection


