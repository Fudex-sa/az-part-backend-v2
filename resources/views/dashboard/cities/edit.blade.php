@extends('dashboard.app')

@section('title') {{__('site.update')}} |    {{ $item['name_'.my_lang()] }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.city.store',$item->id) }}" method="post" novalidate>
        @csrf

        <input type="hidden" name="region_id" value="{{ $item->region_id }}" />
    
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_ar"> @lang('site.name_ar') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name_ar" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->name_ar }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_en"> @lang('site.name_en') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name_en" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->name_en }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_hi"> @lang('site.name_hi') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name_hi" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->name_hi }}" />
            </div>
        </div>

        
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.cities',$item->region_id) }}'" class="btn btn-primary"> 
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
