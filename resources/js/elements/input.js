import 'select2';
import $ from 'jquery';

$('.form-control.is-invalid').on('input', function () {
    $(this).removeClass('is-invalid');
});

$('.select2').select2({
    theme: 'bootstrap-5',
});

