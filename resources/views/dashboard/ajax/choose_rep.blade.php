@php
    $route_name = route('rep.choose');
@endphp

<script>

    $(document).on("click","input[name=rep_price_id]:radio",function(){
        
        var rep_price_id = $(this).val();

        var _token = "{{ csrf_token() }}"; 

        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {_token: _token , rep_price_id:rep_price_id},
            success: function (response) {                      
                if(response)
                  $("#delivery_price").html(response.delivery_price);
                  $("#total").html(response.total);
            }
        });            

    });
    
</script>