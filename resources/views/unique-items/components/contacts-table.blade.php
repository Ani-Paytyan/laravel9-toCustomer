<div class="mt-4 mb-4">
    <h4>{{ __('page.unique-item.contacts')}} :</h4>
</div>
<div class="card mb-8">
    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="table-light">
            <tr>
                <th scope="col">{{ __('attributes.user.name')}}</th>
                @if (Gate::allows('destroy-unique-items'))
                    <th scope="col">{{ __('common.actions')}}</th>
                @endif
            </tr>
            </thead>
            <tbody class="contact-list">
            @foreach($uniqueItemContacts as $uniqueItem)
                <tr>
                    <td>{{ $uniqueItem->contact->first_name ? $uniqueItem->contact->getFullNameAttribute() : $uniqueItem->contact->email }}</td>
                    @if (Gate::allows('destroy-unique-items'))
                        <td>
                            <a href="{{ route('unique-item-contacts.destroy', $uniqueItem->uuid) }}"
                               class="btn btn-sm btn-neutral unique-item-contacts-destroy">
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
