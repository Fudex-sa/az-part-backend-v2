
@php
    $route_name = route('admin.next_round');
@endphp

<script>
function next_round(){
    var _token = "{{ csrf_token() }}";
 
    if (confirm("{{ __('site.confirm_move_to_next_round') }}")) {
        $.ajax({
            type: 'GET',
            url: "{{ $route_name }}",
            data: {_token: _token },
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