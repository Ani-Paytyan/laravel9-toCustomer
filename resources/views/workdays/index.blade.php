@extends('layout.dashboard')
@section('title')
    {{ __('page.company.workdays')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @include('layout.partials.messages')
            <div class="card">
                <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
                    <h4 class="text-center text-md-left mb-md-0">{{ __('page.company.workdays')}}</h4>
                    @if (Gate::allows('destroy-working-days'))
                        <form
                            class="mb-0"
                            method="POST"
                            action="{{ route('company-workdays.delete') }}"
                            x-data="{ loading: false }"
                            @submit="loading = true"
                        >
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-primary w-100" :disabled="loading">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                                <x-heroicon-o-calendar-days x-show="!loading" />
                                {{ __('page.company.set_default_working_days')}}
                            </button>
                        </form>
                    @endif
                </div>
                <form
                    class="mb-0"
                    method="POST"
                    action="{{ route("company-workdays.store") }}"
                    x-data="{ loading: false }"
                    @submit="loading = true"
                >
                    <div class="card-body">
                        @csrf
                        @method('POST')
                        @foreach($workingDays as $key => $workingDay)
                            <div class="row">
                                <h4>{{ $weekdays[$workingDay->day_of_week] ?? '' }} :</h4>
                                @if (empty($workingDay->company_id))
                                    <input type="hidden" name="data[{{ $key }}][default]" value="true">
                                @endif
                                <input type="hidden" name="data[{{ $key }}][uuid]" value="{{ $workingDay->uuid }}">
                                <input type="hidden" name="data[{{ $key }}][day_of_week]" value="{{ $workingDay->day_of_week }}">
                                <div class="col-md-2">
                                    @if($workingDay->is_active)
                                        <x-form.checkbox
                                            name="data[{{ $key }}][is_active]"
                                            type="text"
                                            id="is_active_{{ $key }}"
                                            label="{{ __('page.company.working_day') }}"
                                            placeholder="{{ __('page.company.working_day') }}"
                                            class="form-control-muted"
                                            checked
                                        />
                                    @else
                                        <x-form.checkbox
                                            name="data[{{ $key }}][is_active]"
                                            type="text"
                                            id="is_active_{{ $key }}"
                                            label="{{ __('page.company.working_day') }}"
                                            placeholder="{{ __('page.company.working_day') }}"
                                            class="form-control-muted"
                                        />
                                    @endif
                                </div>
                                <div class="col-md">
                                    <x-form.input
                                        name="data[{{ $key }}][from]"
                                        type="time"
                                        id="from_{{ $key }}"
                                        required
                                        label="{{ __('page.company.from') }}"
                                        placeholder="{{ __('page.company.from') }}"
                                        class="form-control-muted"
                                        value="{{ $workingDay->from }}"
                                    />
                                </div>
                                <div class="col-md">
                                    <x-form.input
                                        name="data[{{ $key }}][to]"
                                        type="time"
                                        id="to_{{ $key }}"
                                        required
                                        label="{{ __('page.company.to') }}"
                                        placeholder="{{ __('page.company.to') }}"
                                        class="form-control-muted"
                                        value="{{ $workingDay->to }}"
                                    />
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if (Gate::allows('create-working-days'))
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success" :disabled="loading">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                                <x-heroicon-o-check x-show="!loading" />
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    @endif
                </form>

            </div>
        </div>
    </div>
@endsection
