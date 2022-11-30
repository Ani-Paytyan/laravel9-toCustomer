<div class="card mb-8">
    <form action="{{ route('teams.index') }}" method="get">
        <div class="row p-4 pb-4">
            <div class="col-sm-4">
                <x-form.input
                    name="name"
                    type="text"
                    id="filter_name"
                    placeholder="{{ __('attributes.user.name')}}"
                    class="form-control-muted"
                    value="{{ $_GET['name'] ?? old('name') }}"
                />
            </div>
            <div class="col-sm-5">
                <x-form.input
                    name="description"
                    type="text"
                    id="filter_description"
                    placeholder="{{ __('attributes.team.description') }}"
                    class="form-control-muted"
                    value="{{ $_GET['description'] ?? old('description') }}"
                />
            </div>
            <div class="col-sm-3">
                <button class="btn btn-primary filter-form">
                    <i class="bi bi-funnel"></i>
                    {{ __('attributes.filter.title') }}
                </button>
                <button type="button" class="btn btn-warning filter-clean-form">
                    <i class="bi bi-x-circle"></i>
                    {{ __('attributes.filter.clean') }}
                </button>
            </div>
        </div>
    </form>
</div>
