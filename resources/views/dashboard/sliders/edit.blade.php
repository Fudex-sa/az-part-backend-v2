@extends('dashboard.layouts.app')

@section('title') {{__('site.update')}} |    {{ $item->title }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.slider.store',$item->id) }}"
         method="post" enctype="multipart/form-data" novalidate>
        @csrf
    

        <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
                    
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img"> @lang('site.image') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" name="img" class="col-md-7 col-xs-12" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> @lang('site.title') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="title" class="form-control col-md-7 col-xs-12" required 
                value="{{ $item->title }}" />
            </div>
        </div> 
        
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description"> @lang('site.description') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="description" class="form-control col-md-7 col-xs-12"> {{ $item->description }} </textarea>
               
            </div>
        </div> 
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.sliders') }}'" class="btn btn-primary"> 
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
