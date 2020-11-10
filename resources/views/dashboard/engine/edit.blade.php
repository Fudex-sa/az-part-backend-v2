@extends('dashboard.app')

@section('title') @lang('site.request') {{ $item->id }} - @lang('site.seller')
                    {{ $item->broker ? $item->broker->name : $item->seller->name }}    
@endsection

@section('styles')
    
@endsection


@section('content')

<div class="col-md-6 col-sm-12 col-xs-12">
   
    <div class="x_panel">
        <div class="x_title">
            <h2>  @lang('site.offer_details_no') {{ $item->id }}  </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                  
            </ul>
            <div class="clearfix"></div>
        </div>
    
        <div class="x_content">
    
            <div class="table-responsive">

                <table class="table table-striped">
                    <tr>
                        <th> # </th>
                        <td> {{ $item->id }} </td>
                    </tr>

                    <tr>
                        <th> <i class="fa fa-camera"></i> </th>
                        <td> 
                            @if($item->seller_type == 'broker')
                                @if($item->broker->photo) <img src="{{ img_path($item->broker->photo) }}" class="img-user" />
                                @else <img src="{{ site('assets/images/logo.png') }}" class="img-user" /> @endif
                            @else
                                @if($item->seller->photo) <img src="{{ img_path($item->seller->photo) }}" class="img-user" />
                                @else <img src="{{ site('assets/images/logo.png') }}" class="img-user" /> @endif
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th> @lang('site.seller_name') </th>
                        <td> {{ $item->seller_type == 'broker' ? $item->broker->name : $item->seller->name }} </td>
                    </tr>
                    
                    <tr>
                        <th> @lang('site.mobile') </th>
                        <td> {{ $item->seller_type == 'broker' ? $item->broker->mobile : $item->seller->mobile }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.seller_type') </th>
                        <td> {{ __('site.'.$item->seller_type) }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.request') </th>
                        <td> ER-{{  $item->request_id }}  </td>
                    </tr>

                    <tr>
                        <th> @lang('site.price') </th>
                        <td> {{ $item->price ? $item->price . __('site.rs') : '-' }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.status') </th>
                        <td> {{ $item->status['name_'.my_lang()] }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.taken') </th>
                        <td> {{ $item->taken == 1 ? __('site.yes') : __('site.no') }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.composition') </th>
                        <td> {{ $item->composition == 1 ? __('site.yes') : __('site.no') }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.return_possibility') </th>
                        <td> {{ $item->return_possibility == 1 ? __('site.yes') : __('site.no') }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.delivery_possibility') </th>
                        <td> {{ $item->delivery_possibility == 1 ? __('site.yes') : __('site.no') }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.created_at') </th>
                        <td> {{ $item->created_at }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.updated_at') </th>
                        <td> {{ $item->updated_at }} </td>
                    </tr>

                </table>
                
            </div>
        </div>
    </div>
</div>


<div class="col-md-6 col-sm-12 col-xs-12">
   
    <div class="x_panel">
        <div class="x_title">
            <h2>  @lang('site.send_offer')  </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                  
            </ul>
            <div class="clearfix"></div>
        </div>
    
        <div class="x_content">
    
            <div class="table-responsive">
       
                <form class="form-horizontal form-label-left" action="{{ route('admin.engine.update',$item->id) }}" method="post" novalidate>
                    @csrf
             
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="price"> @lang('site.price') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="price" class="form-control col-md-7 col-xs-12" 
                            required value="{{ $item->price }}" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="composition"> @lang('site.composition') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="radio" name="composition" value="1" 
                            {{ $item->composition == 1 ? 'checked' : '' }} /> @lang('site.yes')

                            <input type="radio" name="composition" value="0" 
                            {{ $item->composition == 0 ? 'checked' : '' }} /> @lang('site.no')
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="return_possibility"> @lang('site.return_possibility') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="radio" name="return_possibility" value="1" 
                            {{ $item->return_possibility == 1 ? 'checked' : '' }} /> @lang('site.yes')

                            <input type="radio" name="return_possibility" value="0" 
                            {{ $item->return_possibility == 0 ? 'checked' : '' }} /> @lang('site.no')
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="delivery_possibility"> @lang('site.delivery_possibility') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="radio" name="delivery_possibility" value="1" 
                            {{ $item->delivery_possibility == 1 ? 'checked' : '' }} /> @lang('site.yes')

                            <input type="radio" name="delivery_possibility" value="0" 
                            {{ $item->delivery_possibility == 0 ? 'checked' : '' }} /> @lang('site.no')
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="status_id"> @lang('site.status') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select name="status_id" class="form-control">
                            @foreach ($status as $st)
                                <option value="{{ $st->id }}" {{ $st->id == $item->status_id ? 'selected' : '' }}> {{ $st['name_'.my_lang()] }} </option>    
                            @endforeach
                           </select>
                        </div>
                    </div>
 
                
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-success"> @lang('site.send') </button>
                            <button type="button" onclick="location.href='{{ route('admin.order.engine',$item->request_id) }}'" class="btn btn-primary"> 
                                @lang('site.cancel') </button>            
                        </div>
                    </div>
            
            </form>

            </div>
        </div>
    </div>
</div>


@endsection

@section('popup')
 

@endsection

@section('scripts')
    

@endsection
