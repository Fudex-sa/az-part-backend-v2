@extends('dashboard.layouts.app')

@section('title') {{__('site.contact_us_msg')}}   @endsection

@section('styles')
    
@endsection


@section('content')
      
<form class="form-horizontal form-label-left" >

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> @lang('site.name') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" 
                readonly value="{{ $item->name }}" />
            </div>
        </div>


        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"> @lang('site.email') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->email }}" readonly />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile"> @lang('site.mobile') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"   class="form-control col-md-7 col-xs-12" 
                required value="{{ $item->mobile }}" readonly />
            </div>
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="msg"> @lang('site.msg') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" readonly> {{ $item->msg }} </textarea>
            </div>
        </div>
     
        <div class="item form-group text-center">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="msg">  </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash"></i> </a>

                <a href='mailto:{{$item->email}}?subject=Replay Message' target="_blank" class="btn btn-warning btn-xs">
                        <i class="fa fa-reply"></i> </a>
            </div>
        </div>
     
</form>

<br/> <br/> <br/> <br/>

@endsection

@section('popup')

    

@endsection

@section('scripts')
     
    @include('dashboard.ajax.delete',['target'=>'contact_us']) 

@endsection
