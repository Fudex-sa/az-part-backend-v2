
@extends('site.app')

@section('title')  @lang('site.seller_requests') @endsection

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

          <div class="col-lg-9 col-md-9  col-12">
           
            
          <table class="my-tbl" id="myTbl">
            <thead class=" text-primary">
                <tr>
                    <th>#  </th>
                    <th> @lang('site.the_request') </th>
                    <th> @lang('site.price') </th>
                    <th> @lang('site.composition') </th>
                    <th> @lang('site.return_possibility') </th>
                    <th> @lang('site.delivery_possibility') </th>                    
                    <th> @lang('site.created_at') </th>
                    <th> @lang('site.add_price') </th>                    
              </tr>
              </thead>
              <tbody class="text-center">
                @foreach($items as $k=>$item)
                @if($item->request)
                  <tr>
                    <td> {{ $k+1 }} </td>
  
                    <td>  <a href="{{ route('request.show',$item->request->id) }}" class="btn-edit">
                      <i class="fa fa-eye"></i> ER {{$item->request->id}} </a> </td>
 
                    <td> {{ $item->price ? $item->price .'  '. __('site.rs') : '-'}} </td>

                    <td> @if($item->price) 
                          {{ $item->composition == 1 ? __('site.yes') : __('site.no') }}
                        @else - @endif    
                    </td>

                    <td> @if($item->price) 
                            {{ $item->return_possibility == 1 ? __('site.yes') : __('site.no') }}
                          @else - @endif      
                    </td>

                    <td> @if($item->price) 
                          {{ $item->delivery_possibility == 1 ? __('site.yes') : __('site.no') }} 
                          @else - @endif
                    </td>

                    <td> {{ date('Y-m-d',strtotime($item->created_at)) }} </td>

                    <td> @if($item->status_id == 11) <a href="{{ route('seller.add_price',$item->id) }}"> 
                          <i class="fa fa-plus"> </i> @lang('site.add') </a>
                          @else  
                          <span class="btn status-{{ $item->status_id }}"> {{ $item->status['name_'.my_lang()] }} </span>
                          @endif
                    </td>
                    
                  </tr>
                  @endif
              @endforeach
                  
              </tbody>
        
            </table>
          
        <div class="text-center"> {{ $items->links() }} </div>
         
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 
@endsection

@section('popup')
 
@endsection


@section('scripts')
   
@endsection