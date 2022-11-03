$(document).ready(function() {
    $(".storeAdditionalWorkDay").click(function (e) {
        e.preventDefault();

        if (
            ($('#additional_working_date').val() === '')
            && ($('#additional_working_time_from').val() === '')
            && ($('#additional_working_time_to').val() === '')
        )  {
            return;
        }

        $('#loading').show();

        let formData = {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            date: $('#additional_working_date').val(),
            from: $('#additional_working_time_from').val(),
            to: $('#additional_working_time_to').val()
        };

        sendAjax("POST", $('.additional-working-days-form').attr('action'), formData);
    });

    $(".updateWorkingDay").click(function (e) {
        e.preventDefault();
        $('#loading').show();

        let formData = {
            _method: 'PUT',
            _token: $('meta[name="csrf-token"]').attr('content'),
            date: $(this).parent().parent().find('.input_date').val(),
            from: $(this).parent().parent().find('.input_from').val(),
            to: $(this).parent().parent().find('.input_to').val(),
        };

        sendAjax("PUT", $(this).attr('href'), formData, false);
    });

    $(".destroyWorkingDay").click(function (e) {
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
                }

                $('#loading').hide();
                swalAlert(data.status, data.message);
            },
            error: function (data) {
                $('.preloader').hide();
                console.log(data);
            }
        });
    });


    function sendAjax(type, url, formData, reload = true) {
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.status == 'success') {
                    if (reload) {
                        location.reload();
                    } else {
                        $('#loading').hide();
                    }
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
