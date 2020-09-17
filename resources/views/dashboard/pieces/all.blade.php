@extends('dashboard.layouts.app')

@section('title') @lang('site.pieces_management') @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
            <i class="fa fa-plus"></i>  @lang('site.add') </a> 
     
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

            <td>{{$item->name}}</td>                            
            
            <td>{{count($item->pieceAlternative)}}</td>
            
            <td>
                <a href="{{ route('admin.piece.edit',$item->id) }}" class="btn btn-info btn-xs">
                   <i class="fa fa-edit"></i> </a>

                  <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                      <i class="fa fa-trash"></i> </a>
            </td>
        </tr>
    @endforeach 
         
      </tbody>

    </table>
  
<div class="text-center"> {{ $items->links() }} </div>
 

@endsection

@section('popup')

    @include('dashboard.pieces.create')

@endsection

@section('scripts')
    @include('dashboard.layouts.message') 

    @include('dashboard.ajax.delete',['target'=>'piece']) 
  
@endsection
