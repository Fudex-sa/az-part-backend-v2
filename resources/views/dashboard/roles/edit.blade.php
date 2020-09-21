@extends('dashboard.layouts.app')

@section('title') {{__('site.update')}} |    {{ $item['name_'.my_lang()] }} @endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    
@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.role.store',$item->id) }}" method="post" novalidate>
        @csrf
     
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_ar"> @lang('site.name_ar') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="name_ar" class="form-control col-md-7 col-xs-12" value="{{ $item->name_ar }}" required />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_en"> @lang('site.name_en') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="name_en" class="form-control col-md-7 col-xs-12" value="{{ $item->name_en }}" required />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_hi"> @lang('site.name_hi') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="name_hi" class="form-control col-md-7 col-xs-12" value="{{ $item->name_hi }}" required />
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

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="permissions"> @lang('site.permissions') <span
                    class="required">*</span>
            </label>
            
            <div class="col-md-6 col-sm-6 col-xs-12">
 
                @foreach($permissions as $permission)
 
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <label>
                            @if(in_array($permission->name,$role_permissions))
                                <input type="checkbox" class="flat" name="permissions[]" value="{{ $permission->name }}"  
                                       checked required/> @lang('site.'.$permission->name)
                            @else
                                <input type="checkbox" class="flat" name="permissions[]" value="{{ $permission->name }}"  
                                required/> @lang('site.'.$permission->name)
                            @endif
                        </label>

                    </div>
                   
                @endforeach
            </div>
        </div>
 
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.roles') }}'" class="btn btn-primary"> 
                @lang('site.cancel') </button>

                <button type="submit" class="btn btn-success"> @lang('site.update') </button>
            </div>
        </div>

</form>


@endsection

@section('popup')

    

@endsection

@section('scripts')
     
    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>
  
@endsection
