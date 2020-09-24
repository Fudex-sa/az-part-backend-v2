
@php
    $route_name = route('admin.'.$target.'.activate');
@endphp

<script>
function activate(id){
    var _token = "{{ csrf_token() }}";
 
    if (confirm("{{ __('site.confirm_change_status') }}")) {
        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {_token: _token , id:id},
            success: function (response) {
                if(response == 1)
                    $.growl.notice({title: "{{ __('site.success') }}",message: "{{ __('site.status_changed') }}"  });
                else 
                    $.growl.warning({title: "{{ __('site.failed') }}",message: "{{ __('site.something_wrong_happened') }}"  });
                
                location.reload();     
            }
        });            

    }
};

</script>