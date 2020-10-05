@extends('dashboard.app')

@section('title') {{__('site.update') . ' | ' . __('site.ticker')}}   @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.ticker.store',$item->id) }}"
         method="post" enctype="multipart/form-data" novalidate>
        @csrf
    

        <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
       
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="img"> @lang('site.image') <span
                    class="required">*</span>
            </label>

            <div class="col-md-5 col-sm-6 col-xs-12">
                <input type="file" name="img" class="col-md-7 col-xs-12" />
                
                <img src="{{ asset('uploads/'.$item->img) }}" class="img-tbl"/>
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="link"> @lang('site.link') <span
                    class="required">*</span>
            </label>

            <div class="col-md-5 col-sm-6 col-xs-12">
                <input type="url" name="link" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->link }}" />
            </div>
        </div>
 
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('dashboard') }}'" class="btn btn-primary"> 
                @lang('site.cancel') </button>

                <button type="submit" class="btn btn-success"> @lang('site.update') </button>
            </div>
        </div>

</form>


@endsection

@section('popup')

    

@endsection

@section('scripts')
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    

    <script>
        $('#content').summernote({
            tabsize: 2,
        });
    </script>
  
@endsection
