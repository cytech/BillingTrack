@php($msg = '')
@foreach ($errors->all() as $error)
    @php($msg .= $error . '\n')
@endforeach
@if($msg)
<script>
    notify('{!! $msg !!}','error')
</script>
@endif


@if (session()->has('error'))
    <script>
        notify('{!! session('error') !!}','error')
    </script>
@endif

@if (session()->has('alert'))
    <script>
        notify('{!! session('alert') !!}','warning')
    </script>
@endif

@if (session()->has('alertSuccess'))
    <script>
        notify('{!! session('alertSuccess') !!}','success')
    </script>
@endif

@if (session()->has('alertInfo'))
    <script>
        notify('{!! session('alertInfo') !!}','info')
    </script>
@endif