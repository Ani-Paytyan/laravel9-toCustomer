<div class="mt-4 mb-4">
    <h5>{{ __('page.teams.users')}}</h5>
</div>
<div class="card mb-8">
    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="table-light">
            <tr>
                <th scope="col">{{ __('attributes.user.name')}}</th>
                <th scope="col">{{ __('common.actions')}}</th>
            </tr>
            </thead>
            <tbody class="users-list">
            @foreach($uniqueItemContacts as $uniqueItem)
                <tr>
                    <td>{{ $uniqueItem->user->first_name ? $uniqueItem->user->getFullNameAttribute() : $uniqueItem->user->email }}</td>
                    <td>
                        <a href="{{ route('team_users.destroy', $uniqueItem->uuid) }}"
                           class="btn btn-sm btn-neutral destroyUser">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
