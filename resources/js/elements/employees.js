$(document).ready(function () {
  $('.delete-employee').click(function (e) {
    e.preventDefault();
    if (confirm('Are you sure?')) {
      $(e.target).closest('form').submit();
    }
  });
});
