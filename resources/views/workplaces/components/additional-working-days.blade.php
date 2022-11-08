@if($additionalWorkingDays->count() !== 0)
    <br>
    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="table-light">
            <tr>
                <th scope="col">{{ __('page.company.day')}}</th>
                <th scope="col">{{ __('page.company.time_from')}}</th>
                <th scope="col">{{ __('page.company.time_to')}}</th>
                <th scope="col">{{ __('common.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($additionalWorkingDays as $key => $workingDay)
                <tr>
                    <td>
                        <x-form.input
                            name="data[{{ $key }}][date]"
                            type="date"
                            id="date"
                            required
                            label="{{ __('page.company.day') }}"
                            placeholder="{{ __('page.company.day') }}"
                            class="form-control-muted input_date"
                            value="{{ $workingDay->date }}"
                        />
                    </td>
                    <td>
                        <x-form.input
                            name="data[{{ $key }}][from]"
                            type="time"
                            id="from"
                            required
                            label="{{ __('page.company.from') }}"
                            placeholder="{{ __('page.company.from') }}"
                            class="form-control-muted input_from"
                            value="{{ $workingDay->from }}"
                        />
                    </td>
                    <td>
                        <x-form.input
                            name="data[{{ $key }}][to]"
                            type="time"
                            id="to"
                            required
                            label="{{ __('page.company.to') }}"
                            placeholder="{{ __('page.company.to') }}"
                            class="form-control-muted input_to"
                            value="{{ $workingDay->to }}"
                        />
                    </td>
                    <td>
                        @if (Gate::allows('create-workplace-working-days'))
                            <a href="{{ route('additional-working-days.update', $workingDay->uuid) }}"
                               class="btn btn-sm btn-neutral updateWorkingDay">
                                <i class="bi bi-save"></i>
                            </a>
                        @endif
                        @if (Gate::allows('delete-workplace-working-days'))
                            <a href="{{ route('additional-working-days.delete', $workingDay->uuid) }}"
                               class="btn btn-sm btn-neutral destroyWorkingDay">
                                <i class="bi bi-trash"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
@if (Gate::allows('create-workplace-working-days'))
    <div class="mt-4 mb-4">
        <h5>{{ __('page.additional_working_days.add_date')}}</h5>
    </div>
    <form class="additional-working-days-form" method="POST" action="{{ route("additional-working-days.store", $workPlace->uuid) }}">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-3">
                <x-form.input
                    name="additional_working_date"
                    type="date"
                    id="additional_working_date"
                    required
                    label="{{ __('page.company.day') }}"
                    placeholder="{{ __('page.company.day') }}"
                    class="form-control-muted"
                />
            </div>
            <div class="col-md-3">
                <x-form.input
                    name="additional_working_time_from"
                    type="time"
                    id="additional_working_time_from"
                    required
                    label="{{ __('page.company.from') }}"
                    placeholder="{{ __('page.company.from') }}"
                    class="form-control-muted"
                />
            </div>
            <div class="col-md-3">
                <x-form.input
                    name="additional_working_time_to"
                    type="time"
                    id="additional_working_time_to"
                    required
                    label="{{ __('page.company.to') }}"
                    placeholder="{{ __('page.company.to') }}"
                    class="form-control-muted"
                />
            </div>
            <div class="col-md-3">
                <button class="btn btn-success storeAdditionalWorkDay">
                    <i class="bi bi-person-plus"></i>
                    {{ trans('page.additional_working_days.add_date_btn') }}
                </button>
            </div>
        </div>
    </form>
@endif
