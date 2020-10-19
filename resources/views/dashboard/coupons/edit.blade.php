@extends('dashboard.app')

@section('title') {{__('site.update') .' ' . __('site.coupon')}} |    {{ $item->code }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.coupon.store',$item->id) }}" method="post" novalidate>
        @csrf
    
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code"> @lang('site.code') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="code" class="form-control col-md-7 col-xs-12" required 
            value="{{ $item->code }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value"> @lang('site.value') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" min="1" name="value" class="form-control col-md-7 col-xs-12" required 
            value="{{ $item->value }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uses_number"> @lang('site.uses_number') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" min="1" name="uses_number" class="form-control col-md-7 col-xs-12" required 
            value="{{ $item->uses_number }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expiration_date"> @lang('site.expiration_date') 
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" name="expiration_date" class="form-control col-md-7 col-xs-12"  
            value="{{ $item->expiration_date }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active"> @lang('site.active') <span
                    class="required">*</span>
            </label>

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
            <button type="button" onclick="location.href='{{ route('admin.coupons') }}'" class="btn btn-primary"> 
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
