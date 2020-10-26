@php
    $route_name = route('rep.car_size');
@endphp

<script>

function car_size(size){
    var _token = "{{ csrf_token() }}";
  
        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {_token: _token , size:size},
            success: function (response) {
                 
                if(response == 1)
                    GrowlNotification.notify({
                        title: "{{__('site.success')}}",
                        description: " {{ __('site.save_success') }} ",
                        zIndex: 1056,
                        'type' : 'success'
                    });
                    
                else
                    GrowlNotification.notify({
                        title: "{{__('site.failed')}}",
                        description: " {{ __('site.failed') }} ",
                        zIndex: 1056,
                        'type' : 'error'
                    }); 
                     
                location.reload();     
            }
        });            
 
};
    
</script>