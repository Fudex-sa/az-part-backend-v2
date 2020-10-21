
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

          <div class="col-lg-10 col-md-10  col-12">
           <div class="row">
            <div class="col-lg-7 col-md-8  col-10">

                  <div class="table-responsive">
                    <table class="table mt-5 tabel-success myTbl">
                       <tr>
                          <th> @lang('site.user') </th>
                          <td> {{ $item->user['name'] }} </td>
                       </tr>

                       <tr>
                          <th> @lang('site.status') </th>
                          <td> {{ $item->order_status['name_'.my_lang()] }} </td>
                        </tr>

                       <tr>
                          <th> @lang('site.total') </th>
                          <td> {{ $item->total }} @lang('site.rs') </td>
                        </tr>
                      
                    </table>

                  
                  </div>
            </div>

            <div class="col-lg-5 col-md-4  col-4">
                
                  @include('control.orders.order_shipping')
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
        
        if(status == 'accepted'){          
          $("#delivery_time").show();
          $("#reject_reason").hide();

        }else if(status == 'rejected'){
          $("#reject_reason").show();
          $("#delivery_time").hide();
        }else{
          $("#reject_reason").hide();
          $("#delivery_time").hide();
        }
        
    });

    </script>

@endsection