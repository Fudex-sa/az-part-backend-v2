
@php
    $route_name = route('admin.'.$target.'.deActivate');
@endphp

<script>
function deActivate(id){
    var _token = "{{ csrf_token() }}";
 
    if (confirm("{{ __('site.confirm_change_status') }}")) {
        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {_token: _token , id:id},
            success: function (response) {
                
                if(response == 1)
                    GrowlNotification.notify({
                        title: "{{__('site.success')}}",
                        description: " {{ __('site.status_changed') }} ",
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