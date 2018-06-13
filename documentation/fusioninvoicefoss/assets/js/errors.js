function showErrors(errors) {
    if (errors == null) {
        return;
    }
    $.each(errors, function (id, message) {
        $('#form_group_' + id).addClass('has-error');
        $('#error_message_' + id).html(message);
    });
}

function clearErrors() {
    $.each($('.text-danger'), function () {
        $(this).html('');
    });

    $.each($('.form-group'), function () {
        $(this).removeClass('has-error');
    });
}