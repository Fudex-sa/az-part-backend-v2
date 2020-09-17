@extends('dashboard.layouts.app')

@section('title') @lang('site.Bad_Words') @endsection

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
            <th scope="col">{{__('site.word_ar')}} </th>
            <th scope="col">{{__('site.word_en')}}  </th>
            <th scope="col">{{__('site.word_hi')}}  </th>
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            
            <td>{{$item->word_ar}}</td>
            
            <td>{{$item->word_en}}</td>
            
            <td>{{$item->word_hi}}</td>
           
            <td>
                <a href="{{ route('admin.badwords.edit',$item->id) }}" class="btn btn-info btn-xs">
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

    @include('dashboard.bad_words.create')

@endsection

@section('scripts')
    @include('dashboard.layouts.message') 

    @include('dashboard.ajax.delete',['target'=>'badwords']) 
  
@endsection
