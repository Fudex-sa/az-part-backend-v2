
@extends('site.app')

@section('title') @lang('site.order_details') AZ-{{ $item->id }}  @endsection

@section('styles')
    
@endsection

@section('content')

<section class="profile">
  <div class="container">
    <div class="row">

      @include('layouts.breadcrumb')
 
      <div class="col-md-12">
        <div class="row">

          @include('layouts.nav_side_menu')          

          <div class="col-lg-9 col-md-10  col-12">
           <div class="row">
            <div class="col-lg-7 col-md-8  col-10">

              @include('control.orders.order_details')
                  
            </div>

            <div class="col-lg-5 col-md-5  col-5">
                
                  @include('control.orders.order_shipping')
            </div>

            
            <div class="col-lg-12 col-md-12  col-12">
              <hr/>
            
              @include('control.orders.cart_items')
            </div>

           </div>
          </div>

   
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('popup')
 
    @include('control.orders.update_shipping')
 
@endsection

@section('scripts')

    <script src="{{ site('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script>
      $("input[type='number']").inputSpinner()
    </script>

    <script>
       $(document).on("click","input[name=status]:radio",function(){
        
        var status = $(this).val();
        
        if(status == 8){          
          $("#delivery_time").show();
          $("#reject_reason").hide();

        }else if(status == 9){
          $("#reject_reason").show();
          $("#delivery_time").hide();
        }else{
          $("#reject_reason").hide();
          $("#delivery_time").hide();
        }
        
    });

    </script>

  @include('dashboard.ajax.confirm_paid',['target'=>'rep']) 

@endsection