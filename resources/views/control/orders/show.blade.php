
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
           
                  <div class="table-responsive">
                    <table class="table mt-5 tabel-success myTbl">
                       <tr>
                          <th> @lang('site.user') </th>
                          <td> {{ $item->user['name'] }} </td>
                       </tr>

                       <tr>
                        <th> @lang('site.total') </th>
                        <td> {{ $item->total }} @lang('site.rs') </td>
                     </tr>
                      
                    </table>

                  
                  </div>
                
              </div>

   
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')

    <script src="{{ site('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script>
      $("input[type='number']").inputSpinner()
    </script>

@endsection