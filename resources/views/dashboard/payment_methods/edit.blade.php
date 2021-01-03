@extends('dashboard.app')

@section('title') {{__('site.update')}} |    {{ $item['name_'.my_lang()] }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.payment_method.store',$item->id) }}" 
        method="post" enctype="multipart/form-data">
        @csrf
     
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo"> @lang('site.logo') </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" name="logo" class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_ar"> @lang('site.name_ar') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name_ar" class="form-control col-md-7 col-xs-12" required 
            value="{{ $item->name_ar }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_en"> @lang('site.name_en') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name_en" class="form-control col-md-7 col-xs-12"   
            value="{{ $item->name_en }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_hi"> @lang('site.name_hi') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name_hi" class="form-control col-md-7 col-xs-12"   
            value="{{ $item->name_hi }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deposit"> @lang('site.deposit') </label>

            <div class="col-md-2 col-sm-6 col-xs-12">
                <input type="number" name="deposit" class="form-control col-md-7 col-xs-12"   
            value="{{  $item->deposit }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sort"> @lang('site.sort') <span
                    class="required">*</span>
            </label>

            <div class="col-md-2 col-sm-6 col-xs-12">
                <select name="sort" class="form-control">
                    @for($i = 0; $i <= 15 ; $i++)
                        <option value="{{ $i }}" {{ $item->sort == $i ? 'selected' : '' }}> {{ $i }} </option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_ar"> @lang('site.description_ar') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea name="description_ar" class="form-control">{{ $item->description_ar }}</textarea>
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_en"> @lang('site.description_en') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
               <textarea name="description_en" class="form-control"> {{ $item->description_en }} </textarea>
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_hi"> @lang('site.description_hi') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
               <textarea name="description_hi" class="form-control"> {{ $item->description_hi }} </textarea>
            </div>
        </div>
        
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active"> @lang('site.active')</label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="radio" name="active"  required value="1" {{ $item->active == 1 ? 'checked' : '' }}/> @lang('site.yes')

                <input type="radio" name="active"  value="0" {{ $item->active == 0 ? 'checked' : '' }} /> @lang('site.no')
            </div>
        </div>
 
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.payment_methods') }}'" class="btn btn-primary"> 
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
