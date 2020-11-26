
@extends('site.app')

@section('title') @lang('site.old_stock') @endsection

@section('styles')
    
@endsection

@section('content')
 
<div class="cars-yard">
    <div class="container">
      <div class="row">
        @include('layouts.breadcrumb')

       
        <div class="col-md-5 mt-5 ">

            <h5 class="count-h5-2">
                <li> @lang('site.brand') <span> {{ $brand ? $brand['name_'.my_lang()] : '' }} </span> </li>  
                <li> @lang('site.model') <span> {{ $model ? $model['name_'.my_lang()] : '' }} </span> </li>  
                <li> @lang('site.year') <span> {{ request()->year }} </span> </li>  
                <li> @lang('site.piece') <span> {{ $piece ? $piece['name_'.my_lang()] : '' }} </span> </li>  
            </h5>

           

          </div>


        <div class="col-md-7 tenders">
          <div class="count-head">
             
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              
                <li class="nav-item mr-5">
                  <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                    aria-controls="pills-profile" aria-selected="false"> @lang('site.prices_offers') </a>
                </li>
    
              </ul>
              <div class="tab-content" id="pills-tabContent">
                
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    
    
                  <div class="tender-info-2 mt-5 row">

                    @foreach ($items as $k=>$item)                                          
                        <div class="col-md-8">
                            <img src="{{ site('assets/images/tender.png') }}" alt=""> {{ $item->price }} @lang('site.rs')
                        </div>

                        <div class="col-md-4"> <span> {{ $item->created_at }} </span> </div>
                        
                    @endforeach
    
                  </div>
    
    
                </div>
              </div>
               
            
        </div>

        </div>
        
         
         
         
         
         
      </div>
    </div>
  </div>
  


@endsection

@section('scripts')
   
@endsection