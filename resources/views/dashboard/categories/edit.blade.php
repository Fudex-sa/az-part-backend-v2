@extends('dashboard.app')

@section('title') {{__('site.edit_category')}}  @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.category.store',$item->id) }}" 
        method="post" enctype="multipart/form-data">
        @csrf
    
 
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_ar"> @lang('site.name_ar') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" name="name_ar" value="{{ $item->name_ar }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_en"> @lang('site.name_en') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" name="name_en" value="{{ $item->name_en }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_hi"> @lang('site.name_hi') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" name="name_hi" value="{{ $item->name_hi }}" />
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
 
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.categories') }}'" class="btn btn-primary"> 
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
