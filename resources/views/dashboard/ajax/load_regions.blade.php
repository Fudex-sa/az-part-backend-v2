@php
    $route_name = route('regions.load');
@endphp

<script>

$("#country_id").change(function(){

    var country_id = $(this).val();

    var _token = "{{ csrf_token() }}"; 

        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {_token: _token , country_id:country_id},
            success: function (response) {
                if(response)
                  $("#region_id").html(response);
            }
        });            
 

});
 
</script>