import {swalAlert} from "./general";
import {sendAjax} from "./general";
import $ from 'jquery';

$(document).ready(function() {
    $(".unique-item-contacts-add").click(function (e) {
        e.preventDefault();

        if ($('#contact_id option:selected').val() === '') {
            return;
        }
        $('#loading').show();

        let formData = {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            unique_item_id: $('#unique_item_id').val(),
            contact_id: $('#contact_id option:selected').val()
        };

        sendAjax("POST", $('.unique-item-contacts-form').attr('action'), formData);
    });

    $(".addUniqueItemToContact").click(function (e) {
        e.preventDefault();

        if ($('#unique_item_id option:selected').val() === '') {
            return;
        }
        $('#loading').show();

        let formData = {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            contact_id: $('#contact_id').val(),
            unique_item_id: $('#unique_item_id option:selected').val()
        };

        sendAjax("POST", $('.contacts-unique-item-form').attr('action'), formData);
    });

    $(".unique-item-contacts-destroy").click(function (e) {
        e.preventDefault();
        $('#loading').show();
        const obj = $(this);

        let formData = {
            _method: 'DELETE',
            _token: $('meta[name="csrf-token"]').attr('content'),
        };

        $.ajax({
            type: "DELETE",
            url: $(this).attr('data-href'),
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.status == 'success') {
                    $(obj).closest("tr").remove();
                    location.reload();
                } else {
                    $('#loading').hide();
                }

                swalAlert(data.status, data.message);
            },
            error: function (data) {
                $('.preloader').hide();
                console.log(data);
            }
        });
    });
});
