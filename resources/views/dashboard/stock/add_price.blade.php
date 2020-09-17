@extends('dashboard.layouts.app')

@section('title') {{__('site.add_price')}} |   
        {{ $item->brand ? $item->brand['name'] : '' }} -
        {{ $item->model ? $item->model['name'] : '' }} -
        {{ $item->year }} -
        {{ $item->piece ? $item->piece['name'] : '' }}

@endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.stock.store_price',$item->id) }}"
         method="post" enctype="multipart/form-data" novalidate>
        @csrf
    
        <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
             
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> @lang('site.price') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" name="price" class="form-control col-md-7 col-xs-12" 
                required value="{{ old('price') }}" />
            </div>
        </div>

    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.stock') }}'" class="btn btn-primary"> 
                @lang('site.cancel') </button>

                <button type="submit" class="btn btn-success"> @lang('site.update') </button>
            </div>
        </div>

</form>


@endsection

@section('popup')

    

@endsection

@section('scripts')
     
  
@endsection
