

<form action="{{ route('admin.orders.search') }}" method="get" class="form-horizontal form-label-left">
 
        <div class="form-group col-md-5">
            <label class="col-md-4 col-sm-3 col-xs-12"> @lang('site.type') </label>

            <div class="col-md-8 col-sm-6 col-xs-12">
                <label> <input type="radio" class="flat" name="type" value="electronic" checked required/> @lang('site.electronic') </label>
                <label> <input type="radio" class="flat" name="type" value="manual" required/> @lang('site.manual') </label>
            </div>
        </div>

        <div class="form-group col-md-5">
            <label class="col-md-4 col-sm-3 col-xs-12"> @lang('site.status') </label>

            <div class="col-md-8 col-sm-6 col-xs-12">
                <select name="status" id="status" class="form-control">
                    <option value=""> @lang('site.order_status') </option>
                    
                    @foreach ($order_status as $order_stat)
                        <option value="{{ $order_stat->id }}" {{ request()->status == $order_stat->id ? 'selected' : '' }}>
                             {{ $order_stat['name_'.my_lang()] }} </option>
                    @endforeach
                </select>
            </div>                               
        </div>

        <div class="form-group col-md-5">
            <label class="col-md-4 col-sm-3 col-xs-12"> @lang('site.user_name') </label>

            <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" name="name" class="form-control" value="{{ request()->name }}" />
            </div>
        </div>

        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-success"> @lang('site.search') </button>

            <button type="button" onclick="window.location.href='{{ route('admin.orders') }}'" 
            class="btn btn-primary"> @lang('site.all') </button>
        </div>

</form>