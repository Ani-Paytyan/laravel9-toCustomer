@if ($teams->count() !== 0)
    <div class="mt-4 mb-4">
        <h4>{{ __('page.teams.title')}} :</h4>
    </div>
    <div class="card mb-8">
        <div class="table-responsive">
            <table class="table table-hover table-nowrap">
                <thead class="table-light">
                <tr>
                    <th scope="col">{{ __('attributes.user.name')}}</th>
                    <th scope="col">{{ __('attributes.team.description')}}</th>
                    <th scope="col">{{ __('common.actions')}}</th>
                </tr>
                </thead>
                <tbody class="contact-list">
                @foreach($teams as $team)
                    <tr>
                        <td>
                            <a href="{{ route('teams.edit', $team->uuid) }}">
                                {{ $team->name }}
                            </a>
                        </td>
                        <td>{{ $team->description }}</td>
                        <td>
                            <a href="{{ route('teams.edit', $team->uuid) }}"
                               class="btn btn-sm btn-neutral"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="{{ __('page.teams.title') }}"
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
    @if ($teams->total() > 10)
        <div class="navigation">
            <a href="{{ route('teams.employee-teams', $employee->uuid) }}" class="btn btn-warning">{{ __('common.show_more')}}</a>
        </div>
    @endif
@endif
