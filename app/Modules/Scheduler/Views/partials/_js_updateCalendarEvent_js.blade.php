$("#updateCalendarEvent").submit(function (e) {
    e.preventDefault();
    var reminder_date = [];
    $('input[name^="reminder_date"]').each(function () {
        reminder_date.push($(this).val());
    });
    var reminder_location = [];
    $('input[name^="reminder_location"]').each(function () {
        reminder_location.push($(this).val());
    });
    var reminder_text = [];
    $('textarea[name^="reminder_text"]').each(function () {
        reminder_text.push($(this).val());
    });
    var updateReminder = [];
    for (var key in reminder_date) {
        if (reminder_date[key]) {
            updateReminder[key] = {};
            updateReminder[key].reminder_date = reminder_date[key];
            updateReminder[key].reminder_location = reminder_location[key];
            updateReminder[key].reminder_text = reminder_text[key];
        }
    }

    var title = $("#editTitle").val();
    var description = $("#editDescription").val();
    var start = $("#editStart").val();
    var end = $("#editEnd").val();
    var category = $("#editCategory").val();
    var id = $("#editID").val();
    var oid = $("#editOID").val();
    var eventData;
    $.ajax({
        method: 'post',
        dataType: 'json',
        url: '{!! route("scheduler.updateevent") !!}' + '/' + id,
        data: $("#updateCalendarEvent").serialize(),
        cache: false,
        success: function (data) {
            if (data.type === 'success') {
                notify('{{trans('fi.event_updated')}}', 'success');

                eventData = {
                    id: id,
                    oid: oid,
                    title: title,
                    description: description,
                    start: start,
                    end: end,
                    category: category,
                    color: data.bg_color,
                    textColor: data.text_color,
                    reminder: updateReminder
                };

                $('#calendar').fullCalendar('removeEvents', [eventData.id]);
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                $('#calendar').fullCalendar('unselect');
                $('#editEvent').dialog('close');
            } else {
                notify('{{trans('fi.unknown_error')}}', 'error');
            }
        },
        error: function (response) {
            var msg ='';
            $.each($.parseJSON(response.responseText).errors, function (id, message) {
                msg += message + '\n';
            });
            notify(msg, 'error');
        }
    });
});
