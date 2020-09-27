@php
    $route_name = route('cities.load');
@endphp

<script>

$("#region_id").change(function(){

    var region_id = $(this).val();

    var _token = "{{ csrf_token() }}"; 

        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {_token: _token , region_id:region_id},
            success: function (response) {
                if(response)
                  $("#cities").html(response);
            }
        });            
 

});
 
</script>