<!-- Modal -->
<div class="modal supportModal" id="supportModal" tabindex="-1" role="dialog" aria-labelledby="supportModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" class="supportModalForm" action="{{ route('support.send') }}">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">{{ __('page.support.write_to_us') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <x-form.input
                            name="subject"
                            type="text"
                            id="subject"
                            required
                            label="{{ __('page.support.subject') }}"
                            placeholder="{{ __('page.support.subject') }}"
                            value="{{ old('subject') }}"
                        />
                    </div>
                    <div class="md-form">
                        <x-form.textarea
                            name="support_text"
                            type="text"
                            id="support_text"
                            required
                            label="{{ __('page.support.text') }}"
                            placeholder="{{ __('page.support.text') }}"
                            value="{{ old('support_text') }}"
                        />
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-success btn-unique">{{ __('page.support.send') }} <i class="bi bi-send"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
