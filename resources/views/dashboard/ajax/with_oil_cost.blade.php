@php
    $route_name = route('with_oil');
@endphp

<script>

    $(document).on("click","input[name=with_oil]:radio",function(){
        
        var with_oil = $(this).val();

        var _token = "{{ csrf_token() }}"; 

        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {_token: _token , with_oil:with_oil},
            success: function (response) {      
                console.log(response);

                if(response){
                  $("#with_oil").html(response.with_oil_fees);
                  $("#total").html(response.total);
                }
            }
        });            

    });
    
</script>