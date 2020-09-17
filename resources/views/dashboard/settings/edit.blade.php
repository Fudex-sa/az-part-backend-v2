@extends('dashboard.layouts.app')

@section('title') {{__('site.update')}} |    {{ $item->name }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.setting.store',$item->id) }}" method="post" novalidate>
        @csrf
    

        <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
                    
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> @lang('site.name') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->name }}" />
            </div>
        </div>


        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword"> @lang('site.keyword') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="keyword" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->keyword }}" readonly />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value"> @lang('site.setting_value') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="value" class="form-control col-md-7 col-xs-12" 
                required> {{ $item->value }} </textarea>
            </div>
        </div>
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.settings') }}'" class="btn btn-primary"> 
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
