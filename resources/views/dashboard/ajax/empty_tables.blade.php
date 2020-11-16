
@php
    $route_name = route('admin.empty_tables');
@endphp

<script>
function empty_tables(){
    var _token = "{{ csrf_token() }}";
 
    if (confirm("{{ __('site.confirm_empty') }}")) {
        $.ajax({
            type: 'GET',
            url: "{{ $route_name }}",
            data: {_token: _token },
            success: function (response) {
                if(response == 1)
                    GrowlNotification.notify({
                        title: "{{__('site.success')}}",
                        description: " {{ __('site.empty_save') }} ",
                        zIndex: 1056,
                        'type' : 'success'
                    });
                    
                else
                    GrowlNotification.notify({
                        title: "{{__('site.failed')}}",
                        description: " {{ __('site.something_wrong_happened') }} ",
                        zIndex: 1056,
                        'type' : 'error'
                    }); 
                     
                location.reload();     
            }
        });            

    }
};

</script>