<div class="container-fluid">
    @include('layout.partials.messages')
    <div class="card mb-7">
        <div class="row card-header align-items-center">
            <div class="page-title">
                <h3>{{ __('page.workplaces.title')}}</h3>
            </div>
            @if ($workPlaces->count() !== 0)
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="table-light">
                            <tr>
                                <th scope="col">{{ __('attributes.user.name')}}</th>
                                <th scope="col">{{ __('attributes.user.address')}}</th>
                                <th scope="col">{{ __('attributes.user.zip')}}</th>
                                <th scope="col">{{ __('attributes.workplaces.number')}}</th>
                                <th scope="col">{{ __('attributes.user.city')}}</th>
                                <th scope="col">{{ __('common.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($workPlaces as $workPlace)
                                <tr>
                                    <td>
                                        <a href="{{ route('workplaces.show', $workPlace->uuid) }}">
                                            {{ $workPlace->name }}
                                        </a>
                                    </td>
                                    <td>{{ $workPlace->address }}</td>
                                    <td>{{ $workPlace->zip }}</td>
                                    <td>{{ $workPlace->number }}</td>
                                    <td>{{ $workPlace->city }}</td>
                                    <td>
                                        <a href="{{ route('workplaces.show', $workPlace->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.workplace.title') }}"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        @if (Gate::allows('destroy-workplace-contacts'))
                                            <a href="{{ route('employee-workplaces.delete', [$employee->uuid, $workPlace->uuid]) }}"
                                               class="btn btn-sm btn-neutral destroyContact"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title="{{ __('page.workplace.delete_workplace') }}"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if (Gate::allows('create-workplace-contacts'))
                @if (!empty($workPlaceList))
                    <div class="mt-4 mb-4">
                        <h5>{{ __('page.workplace.add_workplace')}}</h5>
                    </div>
                    <form class="contact-workplaces-form" method="POST"
                          action="{{ route("employee-workplaces.store", $employee->uuid) }}">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-3">
                                <x-form.select
                                    name="workplace_id"
                                    required
                                    id="workplace_id"
                                    label="{{ __('page.workplaces.title') }}"
                                    class="form-select role"
                                    :options="$workPlaceList"
                                />
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success addWorkPlaceToContact">
                                    <i class="bi bi-person-plus"></i>
                                    {{ trans('page.workplace.add_workplace_btn') }}
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>

