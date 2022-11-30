import {swalAlert} from "./general";
import {sendAjax} from "./general";

$(function () {
    $(".workplace-contacts-add").click(function (e) {
        e.preventDefault();

        if ($('#contact_id option:selected').val() === '') {
            return;
        }
        $('#loading').show();

        let formData = {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            contact_id: $('#contact_id option:selected').val()
        };

        sendAjax("POST", $('.workplace-contacts-form').attr('action'), formData);
    });

    $(".addWorkPlaceToContact").click(function (e) {
        e.preventDefault();

        if ($('#workplace_id option:selected').val() === '') {
            return;
        }
        $('#loading').show();

        let formData = {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            workplace_id: $('#workplace_id option:selected').val()
        };

        sendAjax("POST", $('.contact-workplaces-form').attr('action'), formData);
    });
});
