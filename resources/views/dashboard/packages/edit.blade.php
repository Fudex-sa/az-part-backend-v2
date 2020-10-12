@extends('dashboard.app')

@section('title') {{__('site.update')}} |    {{ $item['title_'.my_lang()] }} @endsection

@section('styles')
    
@endsection


@section('content')
     
<form class="form-horizontal form-label-left" action="{{ route('admin.package.store',$item->id) }}" method="post" novalidate>
    @csrf
     
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type"> @lang('site.type') <span
                class="required">*</span>
        </label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="type" class="form-control col-md-7 col-xs-12">
                <option value=""> @lang('site.choose_package') </option>
                <option value="manual" {{ $item->type == 'manual' ? 'selected' : '' }} > @lang('site.manual') </option>
                <option value="electronic" {{ $item->type == 'electronic' ? 'selected' : '' }} > @lang('site.electronic') </option>
            </select>
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_ar"> @lang('site.title_ar') <span
                class="required">*</span>
        </label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="title_ar" class="form-control col-md-7 col-xs-12"
                value="{{ $item->title_ar }}" required />
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_en"> @lang('site.title_en') <span
                class="required">*</span>
        </label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="title_en" class="form-control col-md-7 col-xs-12" 
            value="{{ $item->title_en }}" required />
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_hi"> @lang('site.title_hi') <span
                class="required">*</span>
        </label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="title_hi" class="form-control col-md-7 col-xs-12" 
            value="{{ $item->title_hi }}" required />
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stores_no"> @lang('site.stores_no') <span
                class="required">*</span>
        </label>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <input type="number" min="0" name="stores_no" class="form-control col-md-7 col-xs-12" 
            value="{{ $item->stores_no }}" required />
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> @lang('site.price') <span
                class="required">*</span>
        </label>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <input type="number" min="0" name="price" class="form-control col-md-7 col-xs-12" 
            value="{{ $item->price }}" required />
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount"> @lang('site.discount') <span
                class="required">*</span>
        </label>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <input type="number" min="0" name="discount" class="form-control col-md-7 col-xs-12" 
            value="{{ $item->discount }}" required /> %
        </div>
    </div>
     

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">            
            <button type="button" onclick="location.href='{{ route('admin.packages') }}'" class="btn btn-default"> 
                @lang('site.cancel') </button>

            <button type="submit" class="btn btn-primary"> @lang('site.save')  </button>
        </div>
    </div>

</form>


@endsection

@section('popup')

    

@endsection

@section('scripts')
     
  
@endsection
