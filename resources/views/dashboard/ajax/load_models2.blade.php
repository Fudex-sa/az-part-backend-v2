@php
    $route_name = route('models.load');
@endphp

<script>

$("#brand").change(function(){

    var brand_id = $(this).val();

    var _token = "{{ csrf_token() }}"; 

        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {_token: _token , brand_id:brand_id},
            success: function (response) {
                if(response)
                  $("#model").html(response);
            }
        });            
});
 
</script>