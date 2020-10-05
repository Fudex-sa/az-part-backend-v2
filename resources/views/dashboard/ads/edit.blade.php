@extends('dashboard.app')

@section('title') {{__('site.edit_ad')}}  @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.ad.store',$item->id) }}" 
        method="post" enctype="multipart/form-data">
        @csrf
    
 
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img"> @lang('site.image') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" name="img" class="col-md-7 col-xs-12"/>
            </div>
        </div>


        {{-- <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="width"> @lang('site.choose_width') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="width" id="width" class="form-control col-md-7 col-xs-12">
                    <option disabled selected>{{__('site.choose_width')}}</option>
                    <option value="1" {{ $item->width == 1 ? 'selected' : '' }} >728*90</option>
                    <option value="2" {{ $item->width == 2 ? 'selected' : '' }} >300*250</option>
                </select>
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location"> @lang('site.location') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="location" id="location" class="form-control col-md-7 col-xs-12" required>
                    <option disabled selected>{{__('site.choose_location')}}</option>
                        <option value="damaged" {{ $item->location == 'damaged' ? 'selected' : '' }}> @lang('site.damaged') </option>
                        <option value="antique" {{ $item->location == 'antique' ? 'selected' : '' }}> @lang('site.antique') </option>
                </select>
            </div>
        </div> --}}

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="link"> @lang('site.link') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="url" class="form-control col-md-7 col-xs-12" name="link" value="{{ $item->link }}" />
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
            <button type="button" onclick="location.href='{{ route('admin.ads') }}'" class="btn btn-primary"> 
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
