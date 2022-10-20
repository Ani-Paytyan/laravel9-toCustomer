$(document).ready(function() {
    $(".updateUser").click(function (e) {
        e.preventDefault();
        $('#loading').show();

        let formData = {
            _method: 'PUT',
            _token: $('meta[name="csrf-token"]').attr('content'),
            role: $(this).parent().parent().find('.role option:selected').val()
        };

        $.ajax({
            type: "POST",
            url: $(this).attr('href'),
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('#loading').hide();

                Swal.fire(
                    data.message,
                    '',
                    data.status
                );
            },
            error: function (data) {
                $('.preloader').hide();
                console.log(data);
            }
        });
    });
});
