@extends('dashboard.layouts.app')

@section('title')  {{ $item->name }} @endsection

@section('styles')
    
@endsection


@section('content')

<div class="page-title">
    <div class="title_left">
        <h3> @yield('title')  </h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <form method="get" action="{{ route('admin.pieces.search') }}">
                    <input type="text" name="search_txt" class="form-control" placeholder="@lang('site.search_piece')">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-search" type="submit"> @lang('site.search') </button>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-6 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.edit') | {{ $item->name }} </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>              
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                
                <form action="{{ route('admin.piece.store',$item->id) }}" method="post" data-parsley-validate>
                    @csrf

                    <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />

                    <label for="name"> @lang('site.piece_name')   <span class="required">*</span> :</label>
                    
                    <input type="text" id="name" name="name" class="form-control" value="{{ $item->name }}"  required/>
        
                    <br/>
                    <button type="submit" class="btn btn-primary"> @lang('site.update') </button>

                </form>


            </div>
        </div>

    </div>



    <div class="col-md-6 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.edit') | {{ $item->name }} </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>              
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                
                <form action="{{ route('admin.piece.alts.store') }}" method="post" data-parsley-validate>
                    @csrf

                    <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
                    <input type="hidden" name="piece_id" value="{{$item->id}}" >

                    <label for="name"> @lang('site.alternative_name')   <span class="required">*</span> :</label>
                    
                    <a href="javascript:void(0);" id="add-row"><i class="fa fa-plus-circle"></i></a>

                    <input type="text" name="names[]" class="form-control" required>


                    <div class="append-rows">
                        
                    </div>

                    <br/>
                    <button type="submit" class="btn btn-primary"> @lang('site.save') </button>

                </form>

                <hr/>

                <table class="table table-striped jambo_table bulk_action" id="myTbl">
                    <thead>
                    <tr class="headings">
                        <th scope="col">#  </th>
                        <th scope="col"> {{__('site.alternative_name')}} </th>        
                        <th scope="col"></th>
                    </tr>
                    </thead>
                
                    <tbody>
                        @foreach($alts as $alt)
                        <tr>
                            <td>{{$alt->id}}</td>

                            <td>{{$alt->name}}</td>            
                            
                            <td>
                                <a href="javascript:void(0);" class="btn btn-info btn-xs"
                            data-toggle="modal" data-target=".edit_item{{$alt->id}}"> <i class="fa fa-edit"></i> </a>
                               
                                   <a onclick="deleteItem({{ $alt->id }})" class="btn btn-danger btn-xs">
                                       <i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>

    </div>


</div>


     


@endsection

@section('popup')
    
    @foreach($alts as $alt)
        @include('dashboard.pieces.edit_alt',['alt'=>$alt])
    @endforeach


@endsection

@section('scripts')
    
    @include('dashboard.layouts.message') 

    @include('dashboard.ajax.delete',['target'=>'alt']) 

<script>
    $("#add-row").click(function () {
        $(".append-rows").append('<br/> <input type="text" name="names[]" class="form-control" required>');
    });
</script>
  
@endsection
