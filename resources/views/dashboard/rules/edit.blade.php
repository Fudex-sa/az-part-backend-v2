@extends('dashboard.layouts.app')

@section('title') {{__('site.update')}} |    {{ $item->name }} @endsection

@section('styles')
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.rule.store',$item->id) }}" method="post" novalidate>
        @csrf
    
        <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
        
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> @lang('site.name') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name" class="form-control col-md-7 col-xs-12" required value="{{ $item->name }}" />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> @lang('site.permissions') <span
                    class="required">*</span>
            </label>
            
            <div class="col-md-6 col-sm-6 col-xs-12">
                @foreach($permissions as $permission)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fancy-checkbox">
                            
                            @foreach($rule_permissions as $ru)
                            
                                @if($ru->permission_id == $permission->id)
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" checked/>
                                @endif
                            @endforeach
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" />
                                    
                                <span>{{ __('site.'. $permission->permission) }}</span>
                            </label>
                            
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ url('admin/rules') }}'" class="btn btn-primary"> 
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
