@extends('dashboard.layouts.app')

@section('title') {{__('site.create_new_role')}} @endsection

@section('styles')

    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

@endsection


@section('content')
     
    <form class="form-horizontal form-label-left" action="{{ route('admin.role.store') }}" method="post" novalidate>
        @csrf
     
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="name_ar"> @lang('site.name_ar') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="name_ar" class="form-control col-md-7 col-xs-12" value="{{ old('name_ar') }}" required />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="name_en"> @lang('site.name_en') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="name_en" class="form-control col-md-7 col-xs-12" value="{{ old('name_en') }}" required />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="name_hi"> @lang('site.name_hi') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="name_hi" class="form-control col-md-7 col-xs-12" value="{{ old('name_hi') }}" required />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="active"> @lang('site.active') <span
                    class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            
                <label>
                    <input type="radio" class="flat" name="active" value="1"  
                        {{ old('active') == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                </label>

                <label>
                    <input type="radio" class="flat" name="active" value="0"  
                        {{ old('active') == 0 ? 'checked' : '' }} required/> @lang('site.no')
                </label>

            </div>
        </div>


        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="permissions"> @lang('site.permissions') <span
                    class="required">*</span>
            </label>
            
            <div class="col-md-10 col-sm-6 col-xs-12">
                <table class="table table-striped">
                    <thead>                        
                        <tr>
                            <th> @lang('site.permission') </th>
                            <th> @lang('site.show') </th>
                            <th> @lang('site.addtion') </th>
                            <th> @lang('site.edit') </th>
                            <th> @lang('site.delete') </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($permissions as $item)
                            <tr>
                                <th> {{ __('site.'.$item->section) }} </th>
                                
                                <th> <input type="checkbox" class="show_all" name="permissions[]" value="{{ $item->section }}_show" /> </th>

                                <th> <input type="checkbox" class="add_all" name="permissions[]" value="{{ $item->section }}_add" /> </th>

                                <th> <input type="checkbox" class="edit_all" name="permissions[]" value="{{ $item->section }}_edit" /> </th>

                                <th> <input type="checkbox" class="delete_all" name="permissions[]" value="{{ $item->section }}_delete" /> </th>
                            </tr>
                        @endforeach
                            
                        <tr>
                            <th> </th>
                            <th> <input type="checkbox" id="show_all"/> @lang('site.all') </th>
                            <th> <input type="checkbox" id="add_all"/> @lang('site.all') </th>
                            <th> <input type="checkbox" id="edit_all"/> @lang('site.all') </th>
                            <th> <input type="checkbox" id="delete_all"/> @lang('site.all') </th>
                        </tr>
                     
                    </tbody>
                </table>
            </div>
        </div>
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.roles') }}'" class="btn btn-primary"> 
                @lang('site.cancel') </button>

                <button type="submit" class="btn btn-success"> @lang('site.save') </button>
            </div>
        </div>

</form>


@endsection

@section('popup')

    

@endsection

@section('scripts')
    
    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>  
  
    <script>         
        $("#show_all").click(function(){
            $(':checkbox.show_all').prop('checked', this.checked);    
        });

        $("#add_all").click(function(){
            $(':checkbox.add_all').prop('checked', this.checked);    
        });

        $("#edit_all").click(function(){
            $(':checkbox.edit_all').prop('checked', this.checked);    
        });

        $("#delete_all").click(function(){
            $(':checkbox.delete_all').prop('checked', this.checked);    
        });    
    </script>
@endsection

 
 