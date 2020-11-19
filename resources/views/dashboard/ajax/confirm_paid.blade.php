
@php
    if($target == 'admin')
        $route_name = route('admin.order.confirm_paid');
    else
        $route_name = route('order.confirm_paid');
@endphp

<script>
function confirm_paid(id){
var _token = "{{ csrf_token() }}";

if (confirm("{{ __('site.confirm_paid') }}")) {
    $.ajax({
        type: 'POST',
        url: "{{ $route_name }}",
        data: {_token: _token , id:id},
        success: function (response) {
            
            if(response == 1)
                GrowlNotification.notify({
                    title: "{{__('site.success')}}",
                    description: " {{ __('site.process_success') }} ",
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