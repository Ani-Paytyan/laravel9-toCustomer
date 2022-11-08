@extends('layout.dashboard')
@section('title')
    {{ __('page.company.workdays')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <div class="page-title">
                    <h4><i class="bi bi-calendar-date"></i> {{ __('page.company.workdays')}}</h4>
                    <div class="create-button">
                        @if (Gate::allows('destroy-working-days'))
                            <form method="POST"
                                  class="btn btn-sm p-0"
                                  action="{{ route('company-workdays.delete') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-sm btn-warning">
                                    <i class="bi bi-calendar-date"></i> {{ __('page.company.set_default_working_days')}}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route("company-workdays.store") }}">
                    @csrf
                    @method('POST')
                    @foreach($workingDays as $key => $workingDay)
                        <div class="row g-2">
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
                    @if (Gate::allows('create-working-days'))
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-hdd"></i> {{ trans('common.save') }}
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
