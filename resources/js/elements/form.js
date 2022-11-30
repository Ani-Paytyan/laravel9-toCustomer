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

    $(this).closest('form').find("input[type=text], textarea").val("");
    window.location.href = '?';
});


