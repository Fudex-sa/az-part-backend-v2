@extends('dashboard.layouts.app')

@section('title') {{__('site.update')}} |    {{ $item->title }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.page.store',$item->id) }}"
         method="post" enctype="multipart/form-data" novalidate>
        @csrf
    

        <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
         
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="title"> @lang('site.title') <span
                    class="required">*</span>
            </label>

            <div class="col-md-10 col-sm-6 col-xs-12">
                <input type="text" name="title" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->title }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="content"> @lang('site.content') <span
                    class="required">*</span>
            </label>

            <div class="col-md-10 col-sm-6 col-xs-12">
                <textarea name="content" id="content" class="form-control col-md-7 col-xs-12" 
                required > {{ $item->content }} </textarea>
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
    @include('dashboard.layouts.message') 

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    

    <script>
        $('#content').summernote({
            tabsize: 2,
        });
    </script>
  
@endsection
