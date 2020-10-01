@extends('dashboard.layouts.app')

@section('title')  {{ $item['name_'.my_lang()] }} @endsection

@section('styles')
    
@endsection


@section('content')

<div class="page-title">
    <div class="title_left">
        <h3> 
            <a href="{{ route('admin.dashboard') }}"> @lang('site.dashboard') </a> /
            
            @if(isset($level2)) <a href="{{ route($level2['link']) }}"> 
                    @lang('site.'.$level2['name']) </a> / @endif

            @yield('title')
        </h3>
    </div>
    

    @include('dashboard.pieces.filter')
    
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-6 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.edit') | {{ $item['name_'.my_lang()] }} </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>              
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                
                <form action="{{ route('admin.piece.store',$item->id) }}" method="post" data-parsley-validate>
                    @csrf
 
                    <label for="name_ar"> @lang('site.name_ar')   <span class="required">*</span> :</label>
                    
                    <input type="text" name="name_ar" class="form-control" value="{{ $item->name_ar }}"  required/>
                    <br/>

                    <label for="name_en"> @lang('site.name_en') :</label>

                    <input type="text" name="name_en" class="form-control" value="{{ $item->name_en }}" />
                    <br/>

                    <label for="name_en"> @lang('site.name_hi') :</label>

                    <input type="text" name="name_hi" class="form-control" value="{{ $item->name_hi }}" />
        
                    <br/>
                    <button type="submit" class="btn btn-primary"> @lang('site.update') </button>

                </form>


            </div>
        </div>

    </div>



    <div class="col-md-6 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.alternatives_of') | {{ $item['name_'.my_lang()] }} </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>              
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                
                <form action="{{ route('admin.alt.store',$item->id) }}" method="post" data-parsley-validate>
                    @csrf

                    <input type="hidden" name="piece_id" value="{{$item->id}}" >

                    <label for="name"> @lang('site.alternative_name')   <span class="required">*</span> :</label>
                    
                    <a href="javascript:void(0);" id="add-row"><i class="fa fa-plus-circle"></i></a>

                    <input type="text" name="names_ar[]" placeholder="@lang('site.name_ar')" class="form-control" required>
                    <br/>
                    <input type="text" name="names_en[]" placeholder="@lang('site.name_en')" class="form-control">
                    <br/>
                    <input type="text" name="names_hi[]" placeholder="@lang('site.name_hi')" class="form-control">


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
                        @foreach($item->alts as $alt)
                        <tr>
                            <td>{{$alt->id}}</td>

                            <td>{{$alt['name_'.my_lang()]}}</td>            
                            
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
    
    @foreach($item->alts as $alt)
        @include('dashboard.pieces.edit_alt',['alt'=>$alt])
    @endforeach


@endsection

@section('scripts')
    
    @include('dashboard.layouts.message_growl') 

    @include('dashboard.ajax.delete',['target'=>'alt']) 

<script>
    $("#add-row").click(function () {
        $(".append-rows").append('<hr/> <br/> <input type="text" name="names_ar[]" class="form-control" placeholder="{{ __("site.name_ar") }}" required>'+
        ' <br/> <input type="text" name="names_en[]" class="form-control" placeholder="{{ __("site.name_en") }}">' + 
        ' <br/> <input type="text" name="names_hi[]" class="form-control" placeholder="{{ __("site.name_hi") }}">');
    });
</script>
  
@endsection
