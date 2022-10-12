@extends('layout.dashboard')
@section('title')
    {{ __('employees.edit_employee')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <form method="POST" action="{{ route("employees.store") }}">
                    @csrf
                    @method('POST')
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input name="email"
                                       type="email"
                                       class="form-control"
                                       id="email"
                                       required
                                       placeholder="{{ __('employees.email') }}">
                                <label for="email">{{ __('employees.email') }} <span
                                        class="req">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-md">
                            <select name="role" class="form-select" required aria-label="{{ __('employees.role') }}">
                                <option selected>{{ __('employees.role') }} <span class="req">*</span></option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('employees.invite') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
