{!! Html::script('assets/addons/Workorders/Assets/pnotify/dist/pnotify.confirm.js') !!}

@foreach ($errors->all(':message') as $error)
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            PNotify.prototype.options.styling = "bootstrap3";
            new PNotify({
                //title: 'Error',
                text: "{!! $error !!}",
                type: 'error'//,
                //delay: 5000
            });
        });
    </script>
@endforeach

@if (session()->has('error'))
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            PNotify.prototype.options.styling = "bootstrap3";
            new PNotify({
                //title: 'Error',
                text: "{!! session('error') !!}",
                type: 'error'//,
                //delay: 5000
            });
        });
    </script>
@endif

@if (session()->has('alert'))
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            PNotify.prototype.options.styling = "bootstrap3";
            new PNotify({
                //title: 'Alert',
                text: "{!! session('alert') !!}",
                type: 'notice'//,
                //delay: 5000
            });
        });
    </script>
@endif

@if (session()->has('alertSuccess'))

    <script type="text/javascript" language="javascript" class="init">
        $(function () {
            PNotify.prototype.options.styling = "bootstrap3";
            new PNotify({
                //title: 'Message',
                text: "{!! session('alertSuccess') !!}",
                type: 'success'//,
                //delay: 5000
            });
        });
    </script>

@endif

@if (session()->has('alertInfo'))
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            PNotify.prototype.options.styling = "bootstrap3";
            new PNotify({
                //title: 'Info',
                text: "{!! session('alertInfo') !!}",
                type: 'info'//,
                //delay: 5000
            });
        });
    </script>
@endif

<script type="text/javascript">

    function pnotify(message, type) {
        PNotify.prototype.options.styling = "bootstrap3";
        new PNotify({
            //title: "Message",
            text: message,
            type: type
            //delay: 5000
        });
    }

    function pconfirm(message, link) {
        event.preventDefault();
        PNotify.prototype.options.styling = "bootstrap3";
        new PNotify({
            title: '{{ trans('Workorders::texts.confirm_required') }}',
            text: message,
            icon: 'glyphicon glyphicon-question-sign',
            hide: false,
            confirm: {
                confirm: true
            },
            buttons: {
                closer: false,
                sticker: false
            },
            history: {
                history: false
            },
            addclass: 'stack-modal',
            stack: {
                'dir1': 'down',
                'dir2': 'right',
                'modal': true
            }
        }).get().on('pnotify.confirm', function () {
            window.location.href = link;
        }).on('pnotify.cancel', function () {
            //alert('Oh ok. Chicken, I see.');
        });
    }

    //defaults for pconfirm dialog when called from ajax
    pconfirm_def = {
        styling: "bootstrap3",
        title: '{{ trans('Workorders::texts.confirm_required') }}',
        icon: 'glyphicon glyphicon-question-sign',
        hide: false,
        confirm: {
            confirm: true
        },
        buttons: {
            closer: false,
            sticker: false
        },
        history: {
            history: false
        },
        addclass: 'stack-modal',
        stack: {
            'dir1': 'down',
            'dir2': 'right',
            'modal': true
        }
    };

    function consume_alert() {
        if (_alert) return;
        _alert = window.alert;
        window.alert = function (message) {
            new PNotify({
                title: 'Alert',
                text: message
            });
        };
    }

</script>