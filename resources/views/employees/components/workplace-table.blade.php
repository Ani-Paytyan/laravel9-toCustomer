<div class="card">
    <div class="card-header">
        <h4 class="mb-0">{{ __('page.workplaces.title') }}</h4>
    </div>
    @if ($workPlaces->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-records table-hover">
                <thead>
                <tr>
                    <th>{{ __('attributes.user.name')}}</th>
                    <th>{{ __('attributes.user.address')}}</th>
                    <th>{{ __('attributes.user.zip')}}</th>
                    <th>{{ __('attributes.workplaces.number')}}</th>
                    <th>{{ __('attributes.user.city')}}</th>
                    <th>{{ __('common.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workPlaces as $workPlace)
                    <tr>
                        <td><a href="{{ route('workplaces.show', $workPlace->uuid) }}">{{ $workPlace->name }}</a></td>
                        <td>{{ $workPlace->address }}</td>
                        <td>{{ $workPlace->zip }}</td>
                        <td>{{ $workPlace->number }}</td>
                        <td>{{ $workPlace->city }}</td>
                        <td>
                            <a
                                href="{{ route('workplaces.show', $workPlace->uuid) }}"
                                class="btn btn-square"
                                title="{{ __('page.workplace.title') }}"
                            >
                                <x-heroicon-o-eye />
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if ($workPlaces->hasPages())
            <div class="card-footer pb-0">
                {{ $workPlaces->links() }}
            </div>
        @endif
    @else
        <div class="card-body">
            <i class="text-muted">{{ __('No workplaces') }}</i>
        </div>
    @endif
</div>

