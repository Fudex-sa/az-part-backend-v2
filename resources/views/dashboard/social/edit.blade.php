@extends('dashboard.layouts.app')

@section('title') {{__('site.update')}} |    {{ $item->site }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.social.store',$item->id) }}" method="post" novalidate>
        @csrf
    

        <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
                    
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="site"> @lang('site.site') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="site" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->site }}" />
            </div>
        </div>


        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value"> @lang('site.value') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="url" name="value" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->value }}" />
            </div>
        </div>

         
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.socials') }}'" class="btn btn-primary"> 
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
