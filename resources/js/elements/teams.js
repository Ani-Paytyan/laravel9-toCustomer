$(document).ready(function() {
    $(".updateContact").click(function (e) {
        e.preventDefault();
        $('#loading').show();

        let formData = {
            _method: 'PUT',
            _token: $('meta[name="csrf-token"]').attr('content'),
            role: $(this).parent().parent().find('.role option:selected').val()
        };

        sendAjax("PUT", $(this).attr('href'), formData);
    });

    $(".destroyContact").click(function (e) {
        e.preventDefault();
        $('#loading').show();
        const obj = $(this);

        let formData = {
            _method: 'DELETE',
            _token: $('meta[name="csrf-token"]').attr('content'),
        };

        $.ajax({
            type: "DELETE",
            url: $(this).attr('href'),
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

    $(".addContactToTeam").click(function (e) {
        e.preventDefault();

        if ($('#contact_id option:selected').val() === '') {
            return;
        }
        $('#loading').show();

        let formData = {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            team_id: $('#team_id').val(),
            contact_id: $('#contact_id option:selected').val(),
            role: $('#contact_role option:selected').val()
        };

        sendAjax("POST", $('.team-contact-form').attr('action'), formData);
    });

    $(".addTeamToContact").click(function (e) {
        e.preventDefault();

        if ($('#team_id option:selected').val() === '') {
            return;
        }
        $('#loading').show();

        let formData = {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            contact_id: $('#contact_id').val(),
            team_id: $('#team_id option:selected').val(),
            role: $('#contact_role option:selected').val()
        };

        sendAjax("POST", $('.contact-team-form').attr('action'), formData);
    });

    function sendAjax(type, url, formData) {
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.status == 'success') {
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
    }


    function swalAlert(status, message, toast = true, position = 'top-right') {
        Swal.fire({
            toast: toast,
            icon: status,
            title: message,
            position: position,
            animation: true,
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        });
    }
});
