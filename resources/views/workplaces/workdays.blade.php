@extends('layout.dashboard')
@section('title', __('page.workplaces.workplace'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
            <h4 class="text-center text-md-left mb-md-0">
                {{ __('page.workplaces.workplace')}} "{{ $workPlace->name }} " {{ __('page.workplaces.work_days_title') }}
            </h4>
            @if (Gate::allows('delete-workplace-working-days'))
                <form
                    class="mb-0"
                    method="POST"
                    action="{{ route("workplace-workdays.delete", $workPlace->uuid) }}"
                    x-data="{ loading: false }"
                    @submit="loading = true"
                >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary w-100" :disabled="loading">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                        <x-heroicon-o-calendar-days x-show="!loading" />
                        {{ __('page.company.set_default_working_days') }}
                    </button>
                </form>
            @endif
        </div>
        <form
            class="mb-0"
            method="POST"
            action="{{ route("workplace-workdays.store", $workPlace->uuid) }}"
            x-data="{ loading: false }"
            @submit="loading = true"
        >
            @csrf
            @method('POST')
            <ul class="list-group list-group-flush">
                @foreach($workingDays as $key => $workingDay)
                    @if (empty($workingDay->workplace_id))
                        <input type="hidden" name="data[{{ $key }}][default]" value="true">
                    @endif
                    <input type="hidden" name="data[{{ $key }}][uuid]" value="{{ $workingDay->uuid }}">
                    <input type="hidden" name="data[{{ $key }}][day_of_week]" value="{{ $workingDay->day_of_week }}">

                    <li class="list-group-item" x-data="{ checked: !!{{ $workingDay->is_active }} }" x-cloak>
                        <h5 class="mb-0">
                            <x-form.switcher
                                name="data[{{ $key }}][is_active]"
                                id="is_active_{{ $key }}"
                                :label="$weekdays[$workingDay->day_of_week] ?? __('page.company.working_day')"
                                :checked="$workingDay->is_active"
                                x-model.number="checked"
                            ></x-form.switcher>
                        </h5>
                        <div class="row" x-show="checked" x-collapse>
                            <div class="col-md mt-2">
                                <x-form.input
                                    name="data[{{ $key }}][from]"
                                    type="time"
                                    id="from_{{ $key }}"
                                    required
                                    label="{{ __('page.company.from') }}"
                                    placeholder="{{ __('page.company.from') }}"
                                    value="{{ $workingDay->from }}"
                                />
                            </div>
                            <div class="col-md mt-2">
                                <x-form.input
                                    name="data[{{ $key }}][to]"
                                    type="time"
                                    id="to_{{ $key }}"
                                    required
                                    label="{{ __('page.company.to') }}"
                                    placeholder="{{ __('page.company.to') }}"
                                    value="{{ $workingDay->to }}"
                                />
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            @if (Gate::allows('create-workplace-working-days'))
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

    <div class="mt-4">
        @include('workplaces.components.additional-working-days')
    </div>
@endsection
