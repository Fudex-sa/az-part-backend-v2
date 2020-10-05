@extends('dashboard.app')

@section('title') {{__('site.update')}} |    {{ $item['title_'.my_lang()] }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.slider.store',$item->id) }}"
         method="post" enctype="multipart/form-data" novalidate>
        @csrf
    
                     
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img"> @lang('site.image') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" name="img" class="col-md-7 col-xs-12" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_ar"> @lang('site.title_ar') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="title_ar" class="form-control col-md-7 col-xs-12"  value="{{ $item->title_ar }}" />
            </div>
        </div> 

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_en"> @lang('site.title_en') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="title_en" class="form-control col-md-7 col-xs-12" value="{{ $item->title_en }}" />
            </div>
        </div> 

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_hi"> @lang('site.title_hi') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="title_hi" class="form-control col-md-7 col-xs-12" value="{{ $item->title_hi }}" />
            </div>
        </div> 
        
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_ar"> @lang('site.content_ar') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="content_ar" class="form-control col-md-7 col-xs-12"> {{ $item->content_ar }} </textarea>                           
            </div>
        </div> 

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_en"> @lang('site.content_en') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="content_en" class="form-control col-md-7 col-xs-12"> {{ $item->content_en }} </textarea>                           
            </div>
        </div> 

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_hi"> @lang('site.content_hi') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="content_hi" class="form-control col-md-7 col-xs-12"> {{ $item->content_hi }} </textarea>                           
            </div>
        </div> 
    
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active"> @lang('site.active') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <label>
                    <input type="radio" class="flat" name="active" value="1"  
                        {{ $item->active == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                </label>

                <label>
                    <input type="radio" class="flat" name="active" value="0"  
                        {{ $item->active == 0 ? 'checked' : '' }} required/> @lang('site.no')
                </label>
                
            </div>
        </div> 

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sort"> @lang('site.sort') </label>

            <div class="col-md-2 col-sm-6 col-xs-12">
                <select name="sort" id="sort" class="form-control">
                    @for($i = 0 ; $i <= 20 ; $i++)
                        <option value="{{ $i }}" {{ $item->sort == $i ? 'selected' : '' }}> {{ $i }} </option>
                    @endfor
                </select>
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
