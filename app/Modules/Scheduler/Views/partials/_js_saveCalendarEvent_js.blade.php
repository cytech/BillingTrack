{{--<script>--}}
$("#saveCalendarEvent").on("submit", function (e) {
    e.preventDefault();
    const reminder_date = [];
    $('input[name^="reminder_date"]').each(function () {
        reminder_date.push($(this).val());
    });
    const reminder_location = [];
    $('input[name^="reminder_location"]').each(function () {
        reminder_location.push($(this).val());
    });
    const reminder_text = [];
    $('textarea[name^="reminder_text"]').each(function () {
        reminder_text.push($(this).val());
    });
    let createReminder = [];
    for (let key in reminder_date) {
        if (reminder_date[key]) {
            createReminder[key] = {};
            createReminder[key].reminder_date = reminder_date[key];
            createReminder[key].reminder_location = reminder_location[key];
            createReminder[key].reminder_text = reminder_text[key];
        }
    }

    const title = $("#title").val();
    const description = $("#description").val();
    const start = $("#from").val();
    const end = $("#to").val();
    const category = $("#category").val();
    const id = $("#id").val();
    const oid = $("#oid").val();
    let eventData;

    $.ajax({
        url: (id) ? '{!! route("scheduler.updateevent") !!}' + '/' + id : '{!! route("scheduler.updateevent") !!}'  ,
        method: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        cache: false,
    }).done(function (data) {
        if (data.type === 'success') {
            notify( (id) ? '@lang('fi.event_updated')' : '@lang('fi.event_created')' , 'success');
            eventData = {
                id: (id) ? id : parseInt(data.data) ,
                oid: (oid) ? oid :  parseInt(data.dataoid) ,
                title: title,
                description: description,
                start: start,
                end: end,
                color: data.bg_color,
                textColor: data.text_color,
                category: category,
                reminder: createReminder
            };
            $('#calendar').fullCalendar('removeEvents', [eventData.id]);
            $('#calendar').fullCalendar('renderEvent', eventData, true);
            $('#calendar').fullCalendar('unselect');
            $('#calEventDialog').dialog('close');
            $('input[name^="reminder_date"]').each(function () {
                $(this).val('');
            });
            $('input[name^="reminder_location"]').each(function () {
                $(this).val('');
            });
            $('input[name^="reminder_text"]').each(function () {
                $(this).val('');
            });
            createReminder = [];
        } else {
            notify('@lang('fi.unknown_error')', 'error');
        }
    }).fail(function (response) {
        if (response.status === 422) {
            let msg = '';
            $.each($.parseJSON(response.responseText).errors, function (id, message) {
                msg += message + '\n';
            });
            notify(msg, 'error');
        } else {
            notify('@lang('fi.unknown_error')', 'danger');
        }
    });

});
{{--</script>--}}