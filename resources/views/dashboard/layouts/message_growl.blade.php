
<script src="{{ asset('growl/jquery.growl.js') }}" type="text/javascript"></script>
<link href="{{ asset('growl/jquery.growl.css') }}" rel="stylesheet">


@if(Session::has('success'))
<script>
    $.growl.notice({ 
        title: "{{__('site.success')}}" , message: " {{ Session::get('success') }} "
    });
</script>
@endif

@if(Session::has('failed'))
<script>
    $.growl.warning({ 
        title: "{{__('site.failed')}}" , message: " {{ Session::get('failed') }} "
    });
</script>
@endif

@if ($errors->any())
<script>
    $.growl.warning({ 
        title: "{{__('site.failed')}}" , message: "@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach"
    });
</script>
@endif