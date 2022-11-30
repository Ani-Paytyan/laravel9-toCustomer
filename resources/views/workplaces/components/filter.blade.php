<div class="card mb-8">
    <form action="{{ route('workplaces.index') }}" method="get">
        <div class="row p-4 pb-4">
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
                    name="address"
                    type="text"
                    id="filter_address"
                    placeholder="{{ __('attributes.user.address') }}"
                    class="form-control-muted"
                    value="{{ $_GET['address'] ?? old('address') }}"
                />
            </div>
            <div class="col-sm-3">
                <x-form.input
                    name="city"
                    type="text"
                    id="filter_city"
                    placeholder="{{ __('attributes.user.city') }}"
                    class="form-control-muted"
                    value="{{ $_GET['city'] ?? old('city') }}"
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
