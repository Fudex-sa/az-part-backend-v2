@extends('dashboard.app')

@section('title') {{ __('site.update') .' | '. $item->title }} @endsection

@section('styles')
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
@endsection


@section('content')
    
<div class="" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">

        <li role="presentation" class="active"><a href="#tab_content1" role="tab" id="car_details"
            data-toggle="tab" aria-expanded="false"> @lang('site.car_details') </a>
        </li>

        <li role="presentation" class=""><a href="#tab_content2" id="car_images" role="tab" data-toggle="tab"
                                                  aria-expanded="true"> @lang('site.car_images') </a>
        </li>
        
    </ul>
    <div id="myTabContent" class="tab-content">
        
        <div role="tabpanel" class="tab-pane fade  active in" id="tab_content1" aria-labelledby="car_details">

            <form class="form-horizontal form-label-left" action="{{ route('admin.car.store',$item->id) }}"
                method="post" enctype="multipart/form-data" novalidate>
               @csrf
             
               {{-- <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img"> @lang('site.car_image') <span
                           class="required">*</span>
                   </label>
            
                   <div class="col-md-6 col-sm-6 col-xs-12">
                       <input type="file" name="img" class="col-md-7 col-xs-12" required/>
                   </div>
               </div> --}}
            
               <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> @lang('site.title') <span
                            class="required">*</span>
                    </label>
            
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="title" class="form-control col-md-7 col-xs-12" value="{{ $item->title }}" required/>
                    </div>
                </div>
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_id"> @lang('site.brand') <span
                            class="required">*</span>
                    </label>
            
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option disabled selected>{{__('site.choose_brand')}}</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" @if($item->brand_id == $brand->id) selected @endif>
                                    {{$brand['name_'.my_lang()]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="model"> @lang('site.model') <span
                            class="required">*</span>
                    </label>
            
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="model_id" id="model_id" class="form-control">
                            <option disabled selected> {{__('site.choose_model')}}</option>
                            @foreach($models as $model)
                                <option value="{{$model->id}}" @if($item->model_id == $model->id) selected @endif>
                                        {{$model['name_'.my_lang()]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="year"> @lang('site.year') <span
                            class="required">*</span>
                    </label>
            
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="year" id="year" class="form-control">
                            <option disabled selected>{{__('site.manufacturing_year')}}</option>
                            @for($i = 1970 ; $i <= 2019 ; $i++)
                                <option value="{{$i}}" @if($item->year == $i) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
               
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> @lang('site.car_type') <span
                            class="required">*</span>
                    </label>
            
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label> 
                            <input id="car_damaged" type="radio" name="type" value="damaged" class="flat"
                            {{$item->type == 'damaged' ? 'checked' : ''}} > {{__('site.damaged_cars')}}   
                        </label>
            
                        <label>
                            <input id="car_antique" type="radio" name="type" value="antique" class="flat"
                            {{$item->type == 'antique' ? 'checked' : ''}} > {{__('site.antique_cars')}}   
                        </label>
                    </div>
                </div>
            
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">   </label>
            
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label> 
                            <input id="original_yes" type="radio" name="original" value="1" @if($item->original == '1') 
                            class="flat" checked @endif> {{__('site.original')}}
                        </label>
            
                        <label>
                            <input id="original_no" type="radio" name="original" value="0" @if($item->original == '0') 
                            class="flat" checked @endif> {{__('site.replica')}}   
                        </label>
                    </div>
                </div>
            
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="car_type"> @lang('site.original_manufacture_year')   </label>
            
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" name="original_manufacture_year" class="form-control" value="{{$item->original_manufacture_year}}">   
                    </div>
            
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="car_type"> @lang('site.replica_manufacture_year')   </label>
            
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" name="replica_manufacture_year" class="form-control" value="{{$item->replica_manufacture_year}}">   
                    </div>
                </div>
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="car_color"> @lang('site.car_color')   </label>
            
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" name="color" class="form-control" value="{{$item->color}}">   
                    </div>
            
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="kilometers"> @lang('site.kilometers')   </label>
            
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="number" name="kilo_no" class="form-control" value="{{$item->kilometers}}">   
                    </div>
                </div>
            
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city"> @lang('site.city')   </label>
            
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="city_id" id="city_id">
                            <option value="0" disabled selected> {{__('site.choose_city')}}</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}" @if($item->city_id == $city->id) selected @endif>
                                        {{$city['name_'.my_lang()]}}</option>
                            @endforeach
                        </select>    
                    </div>
                </div>
            
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> @lang('site.price')   </label>
             
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <label> 
                            <input id="price1" type="radio" name="price_type" value="fixed" class="flat" 
                            {{ $item->price_type == 'fixed' ? 'checked' : ''}} > {{__('site.fixed_price')}}
                        </label>
            
                        <label>
                            <input id="price2" type="radio" name="price_type" value="fees" class="flat"
                            {{ $item->price_type == 'fees' ? 'checked' : ''}}  > {{__('site.price_on_bidding')}} 
                        </label>
                    </div>
             
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="number" name="price" class="form-control" value="{{$item->price}}">   
                    </div>
                </div>
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="validatly"> @lang('site.validatly')   </label>
             
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <label> 
                            <input id="yes" type="radio" name="validatly" @if($item->validatly == 1) checked @endif 
                            class="flat" value="1"> {{__('site.yes')}}
                        </label>
            
                        <label>
                            <input id="no" type="radio" name="validatly" value="0" @if($item->validatly == 0) checked @endif
                            class="flat"> {{__('site.no')}}
                        </label>
                    </div>
              
                </div>
            
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                        @lang('site.periodic_inspection_validity')   </label>
             
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <label> 
                            <input type="radio" class="flat" name="examination" value="1"
                                           @if($item->examination == 1) checked @endif >
                                    {{__('site.yes')}}
                        </label>
            
                        <label>
                            <input type="radio" class="flat" name="examination" value="0" 
                                           @if($item->examination == 0) checked @endif>
                                    {{__('site.no')}}
                        </label>
                    </div>
              
                </div>
            
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="publish">  @lang('site.publish')   </label>
             
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <label> 
                            <input id="publish_yes" type="radio" name="publish" @if($item->publish == 1) 
                            class="flat" checked @endif value="1"> {{__('site.yes')}}
                        </label>
            
                        <label>
                            <input id="publish_no" type="radio" name="publish" value="0" @if($item->publish == 0) 
                            class="flat" checked @endif> {{__('site.no')}}
                        </label>
                    </div>
              
                </div>
            
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_auction">  @lang('site.date_auction')   </label>
             
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control col-md-7 col-xs-12 datepicker" name="date_auction" value="{{$item->date_auction}}">
                    </div>
              
                </div>
            
            
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="details">  @lang('site.details')   </label>
             
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="notes">{{$item->notes}}</textarea>
                    </div>
              
                </div>
            
                
            
            
               <div class="ln_solid"></div>
               <div class="form-group">
                   <div class="col-md-6 col-md-offset-3">
                       @if($item->type == 'damaged')
                        <button type="button" onclick="location.href='{{ route('admin.damaged') }}'" class="btn btn-primary"> 
                            @lang('site.cancel') </button>

                       @else
                        <button type="button" onclick="location.href='{{ route('admin.antiques') }}'" class="btn btn-primary"> 
                            @lang('site.cancel') </button>
                       @endif
            
                       <button type="submit" class="btn btn-success"> @lang('site.update') </button>
                   </div>
               </div>
            
            </form>

        </div>


        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="car_images">
            <form class="form-horizontal form-label-left" action="{{ route('admin.car.imgs_store',$item->id) }}"
                method="post" enctype="multipart/form-data" novalidate>
               @csrf
             
               <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img"> @lang('site.car_images') <span
                           class="required">*</span>
                   </label>
            
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <div class="col-12 upload-multi">
      
                        @php ($item->imgs) ? $countImgs = 4-count($item->imgs) : $countImgs = 4; @endphp
  
                         @if($item->imgs)
                                @foreach($item->imgs as $k=>$img)
                        <div class="upload-file car-imgs">
                            <label>
                                <div class="upload-icon">
                                    <img class="img-tbl" src="{{asset('uploads/'.$img->photo)}}">
                                </div>
                                <input type="file" name="imgs[]" class="inputfile" />
                                <a href="javascript:void(0);"onclick="deleteItem({{ $img->id }})" class="delImg">
                                    <i class="fa fa-trash"></i> </a>
                            </label>
                        </div>
                         @endforeach
                            @endif
        
                            @for($i=0 ; $i<=$countImgs-1; $i++)
                            <div class="upload-file">
                                {{-- <label for="file-input{{$i}}">
                                    <div class="upload-icon">
                                       <img class="prev" src="{{asset('templates/images/upload-to-cloud.png')}}">
                                    </div>
                                </label> --}}
                                <input type="file" name="imgs[]"  class="inputfile" />
                            </div>
                            @endfor
                   </div>
                </div>
 
               </div>

               <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        @if($item->type == 'damaged')
                        <button type="button" onclick="location.href='{{ route('admin.damaged') }}'" class="btn btn-primary"> 
                            @lang('site.cancel') </button>

                       @else
                        <button type="button" onclick="location.href='{{ route('admin.antiques') }}'" class="btn btn-primary"> 
                            @lang('site.cancel') </button>
                       @endif
             
                        <button type="submit" class="btn btn-success"> @lang('site.update') </button>
                    </div>
                </div>

            </form>

        </div>


    </div>

</div>





@endsection



@section('scripts')

    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>
   
    @include('dashboard.ajax.delete',['target'=>'car_img'])
   
@endsection
