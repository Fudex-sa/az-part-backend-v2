@extends('dashboard.layouts.app')

@section('title') {{__('site.update')}} |    {{ $item['title_'.my_lang()] }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.page.store',$item->id) }}"
         method="post" enctype="multipart/form-data" novalidate>
        @csrf
     
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="title_ar"> @lang('site.title_ar') <span
                    class="required">*</span>
            </label>

            <div class="col-md-10 col-sm-6 col-xs-12">
                <input type="text" name="title_ar" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->title_ar }}" />
            </div>
        </div>


        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="title_en"> @lang('site.title_en') </label>

            <div class="col-md-10 col-sm-6 col-xs-12">
                <input type="text" name="title_en" class="form-control col-md-7 col-xs-12" 
                 value="{{ $item->title_en }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="title_hi"> @lang('site.title_hi') </label>

            <div class="col-md-10 col-sm-6 col-xs-12">
                <input type="text" name="title_hi" class="form-control col-md-7 col-xs-12" 
                 value="{{ $item->title_hi }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="content_ar"> @lang('site.content_ar') <span
                    class="required">*</span>
            </label>

            <div class="col-md-10 col-sm-6 col-xs-12">
                <textarea name="content_ar" id="content_ar" class="form-control col-md-7 col-xs-12" 
                required > {{ $item->content_ar }} </textarea>
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="content_en"> @lang('site.content_en') </label>

            <div class="col-md-10 col-sm-6 col-xs-12">
                <textarea name="content_en" id="content_en" class="form-control col-md-7 col-xs-12"> {{ $item->content_en }} </textarea>
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="content_hi"> @lang('site.content_hi') </label>

            <div class="col-md-10 col-sm-6 col-xs-12">
                <textarea name="content_hi" id="content_hi" class="form-control col-md-7 col-xs-12"> {{ $item->content_hi }} </textarea>
            </div>
        </div>

    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.dashboard') }}'" class="btn btn-primary"> 
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
        $('#content_ar').summernote({
            tabsize: 2,
        });

        $('#content_en').summernote({
            tabsize: 2,
        });

        $('#content_hi').summernote({
            tabsize: 2,
        });
    </script>
  
@endsection
