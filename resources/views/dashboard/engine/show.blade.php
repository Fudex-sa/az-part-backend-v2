@extends('dashboard.app')

@section('title') @lang('site.request_details') ER-{{ $item->id }} @endsection

@section('styles')
    
@endsection


@section('content')
   
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        
        <div class="x_content">
            <div class="col-xs-3">
                <!-- required for floating -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#data" data-toggle="tab"> @lang('site.request_details') </a> </li>                                          
                </ul>
            </div>

            <div class="col-xs-9">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="data">
                        
                        <p class="lead"> @lang('site.request_owner')  </p>
                        <table class="table table-striped">
                            <tbody>
                                
                                <tr>
                                    <th> @lang('site.user') </th>
                                    <td> {{ $item->user ? $item->user->name : '' }} </td>

                                    <th> @lang('site.user_type') </th>
                                    <td> {{ __('site.'.$item->user_type) }} </td>
                                </tr>

                                <tr>
                                    <th> @lang('site.mobile') </th>
                                    <td> {{ $item->user->mobile }} </td>
                                 
                                    <th> @lang('site.phone') </th>
                                    <td> {{ $item->user->phone ? $item->user->phone : '-' }} </td>
                                </tr>

                                <tr>
                                    <th> @lang('site.country') </th>
                                    <td> {{ $item->country ? $item->country['name_'.my_lang()] : '' }} </td>

                                    <th> @lang('site.city') </th>
                                    <td> {{ $item->region ? $item->region['name_'.my_lang()] : '' }} -
                                        {{ $item->city ? $item->city['name_'.my_lang()] : '' }}
                                    </td>
                                </tr> 
                                
                                <tr>
                                    <th> @lang('site.date') </th>
                                    <td> {{ $item->created_at }} </td>

                                    <th> @lang('site.status') </th>
                                    <td> <span class="label-{{ $item->status_id }}"> 
                                        {{ $item->order_status['name_'.my_lang()] }} </span> </td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="lead"> @lang('site.request_info')  </p>
                        <table class="table table-striped">
                            <tbody>
                                
                                <tr>
                                    <tr>
                                        <th> <i class="fa fa-camera"></i> </th>
                                        <td colspan="3"> @if($item->photo) <img src="{{ cart_img($item->photo) }}" class="img-tbl"/> 
                                            @else <img src="{{ site('assets/images/logo.png') }}" class="img-tbl"/> @endif
                                        </td>
                                    </tr>   

                                    <th> @lang('site.model') </th>
                                    <td> {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }} - 
                                        {{ $item->model ? $item->model['name_'.my_lang()] : '' }} -
                                        {{ $item->year }}
                                    </td>

                                    <th> @lang('site.piece_name') </th>
                                    <td> {{ $item->piece_alt ? $item->piece_alt['name_'.my_lang()] : '' }} </td>
                                </tr>

                                <tr>
                                    <th> @lang('site.color') </th>
                                    <th> {{ $item->color ? $item->color : '-' }} </th>

                                    <th> @lang('site.qty') </th>
                                    <th> {{ $item->qty }} </th>
                                </tr>

                                <tr>
                                    <th> @lang('site.notes') </th>
                                    <th colspan="3"> {{ $item->notes ? $item->notes : '-' }} </th>
                                </tr>

                                <tr>
                                    <th> @lang('site.change_order_status') </th>
                                    <td> 
                                    <form method="post" action="{{ route('admin.engine.update_order',$item->id) }}">
                                            @csrf
                                            <div class="row">
                                                
                                                <div class="col-md-10">
                                                    <select class="form-control" name="status_id"> 
                                                        @foreach ($status as $st)
                                                            <option value="{{ $st->id }}" 
                                                                {{ $st->id == $item->status_id ? 'selected' : '' }}> {{ $st['name_'.my_lang()] }} </option>    
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <button class="btn btn-success" type="submit"> @lang('site.save') </button>
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
            
            <div class="clearfix"></div>

        </div>
    </div>
</div>
 

@endsection

@section('popup')
 

@endsection

@section('scripts')
    
@endsection
