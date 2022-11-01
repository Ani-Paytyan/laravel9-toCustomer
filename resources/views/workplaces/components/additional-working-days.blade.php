@if($additionalWorkingDays->count() !== 0)
    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="table-light">
            <tr>
                <th scope="col">{{ __('attributes.team.name')}}</th>
                <th scope="col">{{ __('attributes.team.name')}}</th>
                <th scope="col">{{ __('attributes.user.role')}}</th>
                <th scope="col">{{ __('common.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($additionalWorkingDays as $key => $workingDay)
                <tr>
                    <input type="hidden" name="data[{{ $key }}][uuid]" value="{{ $workingDay->uuid }}">
                    <td>
                        <x-form.input
                            name="data[{{ $key }}][date]"
                            type="date"
                            id="from"
                            required
                            label="{{ __('page.company.date') }}"
                            placeholder="{{ __('page.company.date') }}"
                            class="form-control-muted"
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
                            class="form-control-muted"
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
                            class="form-control-muted"
                            value="{{ $workingDay->to }}"
                        />
                    </td>
                    <td>
                        <a href="{{ route('team-contacts.update', $workingDay->uuid) }}"
                           class="btn btn-sm btn-neutral updateContact">
                            <i class="bi bi-save"></i>
                        </a>
                        <a href="{{ route('team-contacts.destroy', $workingDay->uuid) }}"
                           class="btn btn-sm btn-neutral destroyContact">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

@if (Gate::allows('create-working-days'))
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
