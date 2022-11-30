@extends('layout.dashboard')
@section('title')
    {{ __('page.workplaces.archive_title')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            @include('layout.partials.messages')
            <div class="p-2 pb-4">
                <h4><i class="bi bi-person-workspace"></i> {{ __('page.workplaces.archive_title')}}</h4>
            </div>
            <div class="card mb-8">
                <div class="table-responsive">
                @if($workPlaces->count() > 0)
                    <table class="table table-hover table-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('attributes.user.name')}}</th>
                            <th scope="col">{{ __('attributes.user.address')}}</th>
                            <th scope="col">{{ __('attributes.user.city')}}</th>
                            <th scope="col">{{ __('attributes.workplaces.total-online')}}</th>
                            <th scope="col">{{ __('common.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($workPlaces as $workPlace)
                            <tr>
                                <td>
                                    <a href="{{ route('workplace.archive', $workPlace->uuid) }}">
                                        {{ $workPlace->name }}
                                    </a>
                                </td>
                                <td>{{ $workPlace->address }}</td>
                                <td>{{ $workPlace->city }}</td>
                                <td>
                                    {{ $workPlace->uniqueItems ? $workPlace->uniqueItems->count() : 0 }}
                                    /
                                    {{ $workPlace->uniqueItems ? $workPlace->uniqueItems->where('is_online', 1)->count() : 0 }}
                                </td>
                                <td>

                                    <a href="{{ route('workplace.archive', $workPlace->uuid) }}"
                                       class="btn btn-sm btn-neutral"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{ __('page.workplace.title') }}"
                                    >
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('workplace.restore', $workPlace->uuid) }}"
                                       class="btn btn-sm btn-warning"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{ __('page.workplace.restore_workplace') }}"
                                    >
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info" role="alert">
                        {{ __('page.workplaces.archive_not_found') }}
                    </div>
                @endif
                </div>
            </div>
            <div class="navigation">
                {{ $workPlaces->links() }}
            </div>
        </div>
    </main>
@endsection
