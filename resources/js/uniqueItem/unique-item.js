$(document).ready(function() {
    $('#checkAll').on('change', function(e) {
        let element =  document.getElementById('checkAll');
        let checks = document.getElementsByName("selectCheckbox[]");
        for (let i = 0; i < checks.length; i++) {
            (element.checked) ? checks[i].checked = e : checks[i].checked = false;
        }
    });
});
