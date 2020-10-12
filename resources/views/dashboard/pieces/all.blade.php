@extends('dashboard.app')

@section('title') @lang('site.pieces_management') @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="page-title">
    <div class="title_left">
        <h3> @yield('title')  </h3>
    </div>

    @include('dashboard.pieces.filter')
   
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.pieces')  </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>              
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

<div class="btn-group">
     
    @if(has_permission('pieces_add'))
        <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
     @endif

</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
            <th scope="col">#  </th>
            <th scope="col"> {{__('site.piece_name')}}</th>                        
            <th scope="col">{{__('site.alternative_names')}}</th>
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>

            <td>{{$item['name_'.my_lang()]}}</td>                            
            
            <td>{{count($item->alts)}}</td>
            
            <td>
                @if(has_permission('pieces_edit'))
                    <a href="{{ route('admin.piece',$item->id) }}" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('pieces_delete'))
                    <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i> </a>
                @endif
            </td>
        </tr>
    @endforeach 
         
      </tbody>

    </table>
  
<div class="text-center"> {{ $items->links() }} </div>
 

            </div>
        </div>
    </div>
</div>


@endsection

@section('popup')

    @include('dashboard.pieces.create')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'piece']) 
  
@endsection
