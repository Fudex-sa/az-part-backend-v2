 

<script>
 function rate(rate,item_id){
      var _token = "{{ csrf_token() }}";
      
      $.ajax({
          type: 'POST',
          url: "{{ route('rate') }}",
          data: {_token: _token , rate:rate , item_id:item_id},
          success: function (response) {
            
                if(response == 1)
                    GrowlNotification.notify({
                        title: "{{__('site.success')}}",
                        description: " {{ __('site.seller_rated_successfully') }} ",
                        zIndex: 1056,
                        'type' : 'success'
                    });
                    
                else
                    GrowlNotification.notify({
                        title: "{{__('site.failed')}}",
                        description: " {{ __('site.already_rated_before') }} ",
                        zIndex: 1056,
                        'type' : 'error'
                    }); 
                     
                location.reload();     
            }
      });            
 
};
</script>