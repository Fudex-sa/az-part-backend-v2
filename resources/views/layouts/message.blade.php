
<link rel="stylesheet" href="{{ asset('growl2/colored-theme.min.css') }}">
<script src="{{ asset('growl2/growl-notification.min.js') }}"></script>


@if(Session::has('success'))
<script>
    GrowlNotification.notify({
      title: "{{__('site.success')}}",
      description: " {{ Session::get('success') }} ",
      image: {
        visible: true,
        customImage: '{{ asset('growl2/success.png') }}'
      },
      position: 'top-right',
      closeTimeout: 3000,   
      'type' : 'success'
    });
</script>
@endif

@if(Session::has('failed'))
<script>
    GrowlNotification.notify({
      title: "{{__('site.failed')}}",
      description: " {{ Session::get('failed') }} ",
      image: {
        visible: true,
        customImage: '{{ asset('growl2/error.png') }}'
      },
      position: 'top-right',
      closeTimeout: 3000,   
      'type' : 'error'
    });
</script>
@endif

@if ($errors->any())
<script>
    GrowlNotification.notify({
      title: "{{__('site.failed')}}",
      description: "@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach",      
      image: {
        visible: true,
        customImage: '{{ asset('growl2/error.png') }}'
      },
      position: 'top-right',
      closeTimeout: 3000,      
      'type' : 'error'
    });
     
</script>
@endif

<script> 
    growlNotification.show(); 
</script>