$(document).ready(function() {
    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function(){
        window.location.href = 'lang/change' + "?lang="+ $(this).val();
    });
});
