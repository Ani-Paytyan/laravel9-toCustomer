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
                swalAlert(data.status, data.message);
            },
            error: function (data) {
                $('.preloader').hide();
                console.log(data);
            }
        });
    });


    $(".destroyUser").click(function (e) {
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
                location.reload();
                swalAlert(data.status, data.message);
            },
            error: function (data) {
                $('.preloader').hide();
                console.log(data);
            }
        });
    });

    $(".addUser").click(function (e) {
        e.preventDefault();

        if ($('#user_id option:selected').val() === '') {
            return;
        }
        $('#loading').show();

        let formData = {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            team_id: $('#team_id').val(),
            user_id: $('#user_id option:selected').val(),
            role: $('#user_role option:selected').val()
        };

        $.ajax({
            type: "POST",
            url: $('.team-user-form').attr('action'),
            data: formData,
            dataType: 'json',
            success: function (data) {
                swalAlert(data.status, data.message);
                location.reload();
            },
            error: function (data) {
                $('.preloader').hide();
                console.log(data);
            }
        });
    });

    $(".addUserToTeam").click(function (e) {
        e.preventDefault();

        if ($('#team_id option:selected').val() === '') {
            return;
        }
        $('#loading').show();

        let formData = {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            uuid: $('#user_id').val(),
            team_id: $('#team_id option:selected').val(),
            name: $('#team_id option:selected').text(),
            role: $('#user_role option:selected').val()
        };

        $.ajax({
            type: "POST",
            url: $('.team-user-form').attr('action'),
            data: formData,
            dataType: 'json',
            success: function (data) {
                swalAlert(data.status, data.message);
                location.reload();
            },
            error: function (data) {
                $('.preloader').hide();
                console.log(data);
            }
        });
    });

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
