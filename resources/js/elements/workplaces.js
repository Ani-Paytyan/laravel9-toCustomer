$(document).ready(function () {
  $('.workplace-contacts-add').click(function (e) {
    e.preventDefault();

    if ($('#contact_id option:selected').val() === '') {
      return;
    }
    $('#loading').show();

    let formData = {
      _method: 'POST',
      _token: $('meta[name="csrf-token"]').attr('content'),
      contact_id: $('#contact_id option:selected').val(),
    };

    sendAjax('POST', $('.workplace-contacts-form').attr('action'), formData);
  });

  $('.addWorkPlaceToContact').click(function (e) {
    e.preventDefault();

    if ($('#workplace_id option:selected').val() === '') {
      return;
    }
    $('#loading').show();

    let formData = {
      _method: 'POST',
      _token: $('meta[name="csrf-token"]').attr('content'),
      workplace_id: $('#workplace_id option:selected').val(),
    };

    sendAjax('POST', $('.contact-workplaces-form').attr('action'), formData);
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
      },
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
