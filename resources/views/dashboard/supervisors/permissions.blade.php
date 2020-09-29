<form method="post" action="{{ route('admin.supervisor.permissions',$item->id) }}">
    @csrf
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

            @foreach ($permissions as $row)
                <tr>
                    <th> {{ __('site.'.$row->section) }} </th>
                    
                    <th> <input type="checkbox" class="show_all" name="permissions[]" value="{{ $row->section }}_show"
                        @if(in_array($row->section.'_show',$user_permissions)) checked @endif /> </th>

                    <th> <input type="checkbox" class="add_all" name="permissions[]" value="{{ $row->section }}_add" 
                        @if(in_array($row->section.'_add',$user_permissions)) checked @endif /> </th>

                    <th> <input type="checkbox" class="edit_all" name="permissions[]" value="{{ $row->section }}_edit" 
                        @if(in_array($row->section.'_edit',$user_permissions)) checked @endif /> </th>

                    <th> <input type="checkbox" class="delete_all" name="permissions[]" value="{{ $row->section }}_delete" 
                        @if(in_array($row->section.'_delete',$user_permissions)) checked @endif /> </th>
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

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
        <button type="button" onclick="location.href='{{ route('admin.supervisors') }}'" class="btn btn-primary"> 
            @lang('site.cancel') </button>

            <button type="submit" class="btn btn-success"> @lang('site.save') </button>
        </div>
    </div>

</form>