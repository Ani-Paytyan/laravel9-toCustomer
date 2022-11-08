@extends('layout.dashboard')
@section('title')
    {{ __('page.workplaces.title')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
        @include('layout.partials.messages')
            <div>
                <h4><i class="bi bi-person-workspace"></i> {{ __('page.workplaces.title')}}</h4>
                @if (Gate::allows('create-workplace'))
                    <div class="create-button">
                        <a href="{{ route('workplaces.create') }}" class="btn btn-sm btn-success">
                            <i class="bi bi-person"></i> {{ __('page.workplaces.create')}}
                        </a>
                    </div>
                @endif
            </div>
            <div class="card mb-8">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('attributes.user.name')}}</th>
                                <th scope="col">{{ __('attributes.user.address')}}</th>
                                <th scope="col">{{ __('attributes.user.city')}}</th>
                                <th scope="col">{{ __('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($workPlaces as $workPlace)
                            <tr>
                                <td>{{ $workPlace->name }}</td>
                                <td>{{ $workPlace->address }}</td>
                                <td>{{ $workPlace->city }}</td>
                                <td>
                                    @if (Gate::allows('create-workplace-working-days'))
                                        <a href="{{ route('workplace.workdays', $workPlace->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.workplaces.work_days') }}"
                                        >
                                            <i class="bi bi-calendar-date"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('workplaces.show', $workPlace->uuid) }}"
                                       class="btn btn-sm btn-neutral"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{ __('page.workplace.title') }}"
                                    >
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    @if (Gate::allows('edit-workplace'))
                                        <a href="{{ route('workplaces.edit', $workPlace->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.workplace.edit') }}"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endif
                                    @if (Gate::allows('destroy-workplace'))
                                        <form method="POST"
                                              class="btn btn-sm p-0"
                                              action="{{ route('workplaces.destroy', $workPlace->uuid) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-sm btn-danger delete-employee"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="{{ __('page.workplace.delete_workplace') }}"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
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
        </div>
    </main>
@endsection
