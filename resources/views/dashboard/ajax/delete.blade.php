
@php
    $route_name = route('admin.'.$target.'.delete');
@endphp

<script>
function deleteItem(id){
    var _token = "{{ csrf_token() }}";
 
    if (confirm("{{ __('site.confirm_delete') }}")) {
        $.ajax({
            type: 'DELETE',
            url: "{{ $route_name }}",
            data: {_token: _token , id:id},
            success: function (response) {
                if(response == 1)
                    $.growl.notice({title: "{{ __('site.success') }}",message: "{{ __('site.delete_success') }}"  });
                else 
                    $.growl.warning({title: "{{ __('site.failed') }}",message: "{{ __('site.something_wrong_happened') }}"  });
                
                location.reload();     
            }
        });            

    }
};

</script>