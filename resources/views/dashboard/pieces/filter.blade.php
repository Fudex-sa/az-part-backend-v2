

 <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <div class="input-group">
            <form method="get" action="{{ route('admin.piece.search') }}">
            <input type="text" name="search_txt" value="{{ request()->search_txt }}" class="form-control" placeholder="@lang('site.search_piece')">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-search" type="submit"> @lang('site.search') </button>
                </span>
            </form>
        </div>
    </div>
</div>