@php
    $route_name = route('reps.load');
@endphp

<script>

$("#cities").change(function(){

    var city_id = $(this).val();
    var size = $("input[name='size']:checked").val();

    var _token = "{{ csrf_token() }}"; 

        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {_token: _token , city_id:city_id ,size:size},
            success: function (response) {
                if(response)
                  $("#my_reps").html(response);
            }
        });            
 

});
 
</script>