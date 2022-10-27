<div class="mt-4 mb-4">
    <h4>{{ __('page.workplace.contacts')}} :</h4>
</div>
<div class="card mb-8">
    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="table-light">
            <tr>
                <th scope="col">{{ __('attributes.user.name')}}</th>
                <th scope="col">{{ __('attributes.user.email')}}</th>
                <th scope="col">{{ __('attributes.user.role')}}</th>
                <th scope="col">{{ __('attributes.user.phone')}}</th>
                @if (Gate::allows('destroy-workplace-contacts'))
                    <th scope="col">{{ __('common.actions')}}</th>
                @endif
            </tr>
            </thead>
            <tbody class="contact-list">
            @foreach($workPlaceContacts as $workPlaceContact)
                <tr>
                    <td>{{ $workPlaceContact->contact->getFullNameAttribute() }}</td>
                    <td>{{ $workPlaceContact->contact->email }}</td>
                    <td>{{ $workPlaceContact->contact->role }}</td>
                    <td>{{ $workPlaceContact->contact->phone }}</td>
                    @if (Gate::allows('destroy-workplace-contacts'))
                        <td>
                            <a href="{{ route('workplace-contacts.destroy', $workPlaceContact->uuid) }}"
                               class="btn btn-sm btn-neutral destroyContact">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
