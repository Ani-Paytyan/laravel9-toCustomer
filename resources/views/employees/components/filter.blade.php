<div class="card mb-8">
    <form action="{{ route('employees.index') }}" method="get">
        <div class="row p-4">
            <div class="col-sm-3">
                <x-form.input
                    name="name"
                    type="text"
                    id="filter_name"
                    placeholder="{{ __('attributes.user.name')}}"
                    class="form-control-muted"
                    value="{{ $_GET['name'] ?? old('name') }}"
                />
            </div>
            <div class="col-sm-3">
                <x-form.input
                    name="email"
                    type="text"
                    id="filter_email"
                    placeholder="{{ __('attributes.user.email') }}"
                    class="form-control-muted"
                    value="{{ $_GET['email'] ?? old('email') }}"
                />
            </div>
            <div class="col-sm-3">
                <x-form.select
                    name="role[]"
                    multiple="multiple"
                    id="filter_role"
                    placeholder="{{ __('attributes.user.role') }}"
                    class="form-select form-control-muted select2"
                    :options="$roles"
                />
            </div>
            <div class="col-sm-3">
                <x-form.select
                    name="status[]"
                    multiple="multiple"
                    id="filter_statuses"
                    placeholder="{{ __('attributes.user.status') }}"
                    class="form-select form-control-muted select2"
                    :options="$statuses"
                />
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-sm-12 text-center">
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
