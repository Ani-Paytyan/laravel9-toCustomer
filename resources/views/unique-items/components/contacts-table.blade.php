@if ($uniqueItemContacts->count() !== 0)
    <div class="mt-4 mb-4">
        <h4>{{ __('page.unique-item.contacts')}} :</h4>
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
                <tbody class="contact-list">
                @foreach($uniqueItemContacts as $contact)
                    <tr>
                        <td>
                            <a href="{{ route('employees.show', $contact->uuid) }}">
                                {{ $contact->first_name ? $contact->getFullNameAttribute() : $contact->email }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('employees.show', $contact->uuid) }}"
                               class="btn btn-sm btn-neutral"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="{{ __('page.employees.employee') }}"
                            >
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            @if (Gate::allows('destroy-unique-items'))
                                <a href="{{ route('unique-item-employees.delete', [$uniqueItem->uuid, $contact->uuid]) }}"
                                   class="btn btn-sm btn-neutral unique-item-contacts-destroy"
                                   data-toggle="tooltip" data-placement="top" title="{{ __('page.unique-item.remove_contact_from_unique_item') }}">
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
