<div class="card mb-8">
    <form action="{{ route('unique-items.index') }}" method="get">
        <div class="row p-4">
            <div class="col-sm-3">
                <x-form.select
                    name="item[]"
                    multiple="multiple"
                    id="filter_item"
                    :hide-default-option="true"
                    placeholder="{{ __('attributes.unique-items.item') }}"
                    class="form-select form-control-muted select2"
                    autocomplete="off"
                    :options="$items"
                />
            </div>
            <div class="col-sm-3">
                <x-form.input
                    name="serial_number"
                    type="text"
                    id="filter_serial_number"
                    placeholder="{{ __('attributes.unique-items.item_serial_number')}}"
                    class="form-control-muted"
                    value="{{ $_GET['serial_number'] ?? old('serial_number') }}"
                />
            </div>
            <div class="col-sm-3">
                <x-form.input
                    name="unique_item_name"
                    type="text"
                    id="filter_unique_item_name"
                    placeholder="{{ __('attributes.unique-items.unique_item_name') }}"
                    class="form-control-muted"
                    value="{{ $_GET['unique_item_name'] ?? old('unique_item_name') }}"
                />
            </div>
            <div class="col-sm-3">
                <x-form.input
                    name="unique_item_article"
                    type="text"
                    id="filter_unique_item_article"
                    placeholder="{{ __('attributes.unique-items.unique_item_article') }}"
                    class="form-control-muted"
                    value="{{ $_GET['unique_item_article'] ?? old('unique_item_article') }}"
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
