@extends('layout.dashboard')
@section('title')
    {{ __('page.workplaces.title')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
        @include('layout.partials.messages')
            <div>
                <h4>{{ __('page.workplaces.title')}}</h4>
                <div class="create-button">
                    <a href="{{ route('workplaces.create') }}" class="btn btn-sm btn-success">
                        <i class="bi bi-person"></i> {{ __('page.workplaces.create')}}
                    </a>
                </div>
            </div>
            <div class="card mb-8">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('attributes.user.id')}}</th>
                                <th scope="col">{{ __('attributes.user.name')}}</th>
                                <th scope="col">{{ __('attributes.user.address')}}</th>
                                <th scope="col">{{ __('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($workPlaces as $workPlace)
                            <tr>
                                <td>{{ $workPlace->uuid }}</td>
                                <td>{{ $workPlace->name }}</td>
                                <td>{{ $workPlace->address }}</td>
                                <td>
                                    <a href="{{ route('workplaces.edit', $workPlace->uuid) }}"
                                       class="btn btn-sm btn-neutral">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('workplaces.destroy', $workPlace->uuid) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-sm btn-danger delete-employee">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
