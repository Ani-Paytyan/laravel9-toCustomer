<div class="card">
    <div class="card-header">
        <h4 class="mb-0">{{ __('page.teams.title') }}</h4>
    </div>
    @if ($teams->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-records table-hover">
                <thead class="table-light">
                <tr>
                    <th scope="col">{{ __('attributes.user.name')}}</th>
                    <th scope="col">{{ __('attributes.team.description')}}</th>
                    <th scope="col">{{ __('common.actions')}}</th>
                </tr>
                </thead>
                @foreach($teams as $team)
                    <tr>
                        <td><a href="{{ route('teams.edit', $team->uuid) }}">{{ $team->name }}</a></td>
                        <td>{{ $team->description }}</td>
                        <td>
                            <a
                                href="{{ route('teams.edit', $team->uuid) }}"
                                class="btn btn-square"
                                title="{{ __('page.teams.title') }}"
                            >
                                <x-heroicon-o-eye />
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        @if ($teams->total() > 10)
            <div class="card-footer">
                <a href="{{ route('teams.employee-teams', $employee->uuid) }}" class="btn btn-warning">
                    {{ __('common.show_more')}}
                </a>
            </div>
        @endif
    @else
        <div class="card-body">
            <i class="text-muted">{{ __('No teams') }}</i>
        </div>
    @endif
</div>
