<div class="card">
    <div class="card-header">
        <h4 class="mb-0">{{ __('page.additional_working_days.title')}}</h4>
    </div>
    @if ($additionalWorkingDays->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-records table-hover">
                <thead>
                <tr>
                    <th width="30%">{{ __('page.company.day')}}</th>
                    <th width="25%">{{ __('page.company.time_from')}}</th>
                    <th width="25%">{{ __('page.company.time_to')}}</th>
                    <th width="20%">{{ __('common.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($additionalWorkingDays as $key => $workingDay)
                    <tr x-data="additionalWorkingDayRow">
                        <td>
                            <x-form.input
                                name="data[{{ $key }}][date]"
                                type="date"
                                id="date"
                                required
                                placeholder="{{ __('page.company.day') }}"
                                class="form-control-sm"
                                value="{{ $workingDay->date }}"
                                x-ref="date"
                            />
                        </td>
                        <td>
                            <x-form.input
                                name="data[{{ $key }}][from]"
                                type="time"
                                id="from"
                                required
                                placeholder="{{ __('page.company.from') }}"
                                class="form-control-sm"
                                value="{{ $workingDay->from }}"
                                x-ref="from"
                            />
                        </td>
                        <td>
                            <x-form.input
                                name="data[{{ $key }}][to]"
                                type="time"
                                id="to"
                                required
                                placeholder="{{ __('page.company.to') }}"
                                class="form-control-sm"
                                value="{{ $workingDay->to }}"
                                x-ref="to"
                            />
                        </td>
                        <td>
                            @if (Gate::allows('create-workplace-working-days'))
                                <button
                                    @click.prevent="update('{{ route('additional-working-days.update', $workingDay->uuid) }}')"
                                    class="btn btn-square text-success"
                                    title="{{ __('page.additional_working_days.update') }}"
                                    :disabled="loading"
                                >
                                    <x-heroicon-o-check-circle />
                                </button>
                            @endif
                            @if (Gate::allows('delete-workplace-working-days'))
                                <button
                                    @click.prevent="destroy('{{ route('additional-working-days.delete', $workingDay->uuid) }}', '{{ __("Are you sure?") }}')"
                                    class="btn btn-square text-danger"
                                    title="{{ __('page.additional_working_days.delete') }}"
                                    :disabled="loading"
                                >
                                    <x-heroicon-o-trash />
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="card-body">
            <i class="text-muted">{{ __('No additional working days') }}</i>
        </div>
    @endif
</div>

@if (Gate::allows('create-workplace-working-days'))
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mb-0">{{ __('page.additional_working_days.add_date')}}</h4>
        </div>
        <form
            class="mb-0 additional-working-days-form"
            method="POST"
            x-data="additionalWorkingDayForm('{{ route("additional-working-days.store", $workPlace->uuid) }}')"
            x-bind="form"
        >
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <x-form.input
                            name="additional_working_date"
                            type="date"
                            id="additional_working_date"
                            required
                            label="{{ __('page.company.day') }}"
                            placeholder="{{ __('page.company.day') }}"
                            class="form-control-muted"
                            x-ref="date"
                        />
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <x-form.input
                            name="additional_working_time_from"
                            type="time"
                            id="additional_working_time_from"
                            required
                            label="{{ __('page.company.from') }}"
                            placeholder="{{ __('page.company.from') }}"
                            class="form-control-muted"
                            x-ref="from"
                        />
                    </div>
                    <div class="col-md-4">
                        <x-form.input
                            name="additional_working_time_to"
                            type="time"
                            id="additional_working_time_to"
                            required
                            label="{{ __('page.company.to') }}"
                            placeholder="{{ __('page.company.to') }}"
                            class="form-control-muted"
                            x-ref="to"
                        />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary storeAdditionalWorkDay" :disabled="loading">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                    <x-heroicon-o-plus x-show="!loading" />
                    {{ __('page.additional_working_days.add_date_btn') }}
                </button>
            </div>
        </form>
    </div>
@endif

