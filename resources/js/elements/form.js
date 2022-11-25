import {sendAjax} from "./general";
import $ from 'jquery';

$(".supportModalForm").submit(function(e) {
    e.preventDefault();
    $('#loading').show();

    let form = $(this);
    let actionUrl = form.attr('action');

    $('.modal-backdrop').hide();
    $('.supportModal').hide();

    sendAjax("POST", actionUrl, form.serialize(), false);
});


$('.filter-form').click(function(e){
    $('#loading').show();
});

$('.filter-clean-form').click(function(e){
    $('#loading').show();

    let form = $(this);

    $('input[data-type="search"]').val('');
    $('input[data-type="search"]').trigger("keyup");
});


