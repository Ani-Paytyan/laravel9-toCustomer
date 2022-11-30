import $ from 'jquery';

export function sendAjax(type, url, formData, reload = true) {
    $.ajax({
        type: type,
        url: url,
        data: formData,
        dataType: 'json',
        statusCode: {
            403: function (xhr) {
                swalAlert('error', xhr.message);
            }
        },
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

            swalAlert('error', data.message);
        }
    });
}

export function swalAlert(status, message, toast = true, position = 'top-right') {
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
