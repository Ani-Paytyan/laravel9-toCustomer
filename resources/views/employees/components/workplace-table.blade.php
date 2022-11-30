@if ($workPlaces->count() !== 0)
    <div class="mt-4 mb-4">
        <h4>{{ __('page.workplaces.title')}} :</h4>
    </div>
    <div class="card mb-8">
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
                <tbody class="contact-list">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="navigation">
        {{ $workPlaces->links() }}
    </div>
@endif
