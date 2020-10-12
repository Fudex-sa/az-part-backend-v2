@extends('dashboard.app')

@section('title') {{__('site.request_details')}} AZ- {{$item->id}} @endsection

@section('styles')
    
@endsection


@section('content')
   
 
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
   
    <h3> {{ $item->user['name'] }}  </h3>

    <ul class="list-unstyled user_data">
        <li><i class="fa fa-map-marker user-profile-icon"></i>
            {{ $item->city ? $item->city['name'] : ''}}
        </li>

        <li class="m-top-xs">
            <i class="fa fa-external-link user-profile-icon"></i>
            @lang('site.request')  {{ __('site.'.$item->request_type) }}
        </li>

        <li>
            <i class="fa fa-clock-o"></i>
            {{ date('l - H:i - d/m/Y ', strtotime($item->created_at)) }}
        </li>
    </ul>

    <a class="btn btn-{{ $item->status }}"><i class="fa fa-edit m-right-xs"></i>&nbsp; 
        {{ __('site.'.$item->status) }}
    </a>
    
</div>
 
<div class="col-md-9 col-sm-9 col-xs-12">

    <div class="text-left">
        <button type="button" class="btn btn-danger dropdown-toggle btn-xs" data-toggle="modal"
                data-target=".delete-request-popup">  <i class="fa fa-trash"></i> 
                @lang('site.delete_request')  
        </button>        
    </div>

    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">

            <li role="presentation" class="active"><a href="#tab_content1" role="tab" id="profile-tab"
                data-toggle="tab" aria-expanded="false"> @lang('site.request_details') </a>
            </li>

            <li role="presentation" class=""><a href="#tab_content2" id="home-tab"
                                                      role="tab" data-toggle="tab"
                                                      aria-expanded="true"> @lang('site.the_offers') </a>
            </li>

            <li role="presentation" class=""><a href="#tab_content3" id="home-tab"
                role="tab" data-toggle="tab"
                aria-expanded="true">@lang('site.admin_notes')  </a>
            </li>
            
             
        </ul>
        <div id="myTabContent" class="tab-content">
            
            <div role="tabpanel" class="tab-pane fade  active in" id="tab_content1"
            aria-labelledby="profile-tab">

           <table class="data table table-striped no-margin">
               
               <tbody>
                     
                    @if($item->img != null)
                    <tr>
                        <td>{{__('site.piece_img')}} </td>
                        <td><img src="{{asset('uploads/'.$item->img)}}" class="img-piece"/> </td>
                    </tr>@endif

                    <tr>
                        <td>{{__('site.model')}}   </td>
                         <td>                            
                            {{$item->brand ? $item->brand['name'] : ''}} -
                            {{$item->model ? $item->model['name'] : ''}} -
                            {{ $item->year}} 
                        </td>
                    </tr>
                    <tr>
                        <td>{{__('site.piece_name')}}   </td>
                        <td>
                            {{ $item->pieceAlternaive ? $item->pieceAlternaive->piece['name'] : '' }}
                        </td>
                    </tr>

                    <tr>
                        <td>{{__('site.piece_color')}}   </td>
                        <td>
                            {{ $item->color ? $item->color : '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td>{{__('site.express_service')}}   </td>
                        <td>
                            {{ $item->let_admin_deal == 1 ? __('site.yes') : __('site.no') }}
                        </td>
                    </tr>

                    <tr>
                        <td>{{__('site.accept_offer')}}   </td>
                        <td>
                            {{ $item->accept_offer == 1 ? __('site.yes') : __('site.no') }}
                        </td>
                    </tr>
 
                    <tr>
                        <td>{{__('site.total')}} </td>
                        <td>{{$item->total ? $item->total : 0 }}  @lang('site.rs') </td>
                    </tr>
 
                    <tr>
                        <td>{{__('site.notes')}} </td>
                        <td>{{$item->notes}}</td>
                    </tr>

               </tbody>
           </table>
          
       </div>


            <div role="tabpanel" class="tab-pane fade" id="tab_content2"
                 aria-labelledby="home-tab">


            <table class="data table table-striped no-margin">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th> {{__('site.seller')}} </th>
                        <th> {{__('site.user_type')}}  </th>
                        <th> {{__('site.price')}}</th>
                        <th> {{__('site.details')}}</th>
                        <th> {{__('site.show_seller_mobile')}}</th>
                        <th> {{__('site.accept')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                  
                     @foreach ($item->offers as $key => $row)
                         
                        @if($row->user)
                        <tr>
                            <td>{{$key+1}}</td>

                            <td><a href="{{ route('admin.user.show',$row->user['id']) }}" target="_blank">
                                @if($row->user['vip'] == 1) <i class="fa fa-check green"></i> @endif
                                code{{$row->user['id']}}</a>

                                <i class="fa fa-star" style="color:yellow"></i> ({{$row->user['rating']}})
                            </td>

                            <td><span class="{{$row->user['user_role']}}">
                                {{__('site.'.$row->user['user_role'])}}</span></td>

                            <td>{{$row->price .' '. __('site.rs') }}</td>

                            <td><a href="{{url('admin/offer/'.$row->id)}}" target="_blank">
                                <i class="fa fa-eye"></i> {{__('site.view')}} </a> </td>

                            <td class="text-center"> {{ $row->show_seller_mobile == 1 ? __('site.yes') : __('site.no') }} </td>

                            <td>@if($row->status == 'accepted')<i class="fa fa-check green"></i>@else
                                    <i class="fa fa-times red"></i> @endif </td>

                            <td> @if(Auth::user()->id == $row->user['id'])
                            <a href="javascript:void(0);" itemid="{{$row->id}}"
                                 class="removeOffer btn btn-danger dropdown-toggle btn-xs">
                                <i class="fa fa-trash"></i> </a>  @endif</td>

                        </tr>
                        @endif
                    @endforeach
                         
                    </tbody>
                    
            </table>
                
               
             
            </div>

            <div role="tabpanel" class="tab-pane fade" id="tab_content3"
            aria-labelledby="profile-tab">
 
            <ul class="messages">

                <form method="post" action="{{ route('admin.request.update',$item->id) }}">                        
                    @csrf
                <li>
                    <i class="fa fa-comment"></i>                    
                    <div class="message_wrapper">
                        <h4 class="heading">@lang('site.change_status')  </h4>    

                        <select class="form-control statuses" name="status">
                            <option {{ ($item->status == "processing") ? "selected" : "" }} value="processing">{{ __('site.processing')  }}</option>
                            <option {{ ($item->status == "not_available") ? "selected" : "" }} value="not_available">{{ __('site.not_available')  }}</option>
                            <option {{ ($item->status == "closed") ? "selected" : "" }} value="closed">{{ __('site.closed')  }}</option>
                            <option {{ ($item->status == "paied") ? "selected" : "" }} value="paied">{{ __('site.paied')  }}</option>
                            <option {{ ($item->status == "pending") ? "selected" : "" }} value="pending">{{ __('site.pending')  }}</option>
                            <option {{ ($item->status == "canceled") ? "selected" : "" }} value="canceled">{{ __('site.canceled')  }}</option>                                
                            <option {{ ($item->status == "assign_to_admin") ? "selected" : "" }} value="assign_to_admin">{{ __('site.assign_to_admin')  }}</option>                                
                        </select>
                          
                    </div>
                </li>

                <li>
                    <i class="fa fa-comment"></i>                    
                    <div class="message_wrapper">
                        <h4 class="heading">@lang('site.admin_notes')  </h4>    

                            <textarea name="admin_notes" class="form-control" placeholder="@lang('site.admin_notes_here')"
                            required> {{ $item->admin_notes }} </textarea>                           
                    </div>
                </li>
                <br/>
                 <input type="submit" value="@lang('site.save')" class="btn btn-success">
                    
                </form>

            </ul>
            
          
       </div>
         
             
        </div>
    </div>
</div>
 

@endsection

@section('popup')
<div class="modal fade delete-request-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

        <form action="{{ route('admin.request.delete',$item->id) }}" method="post">
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.reason_for_deletion') </h4>
            </div>
            <div class="modal-body">
               <textarea name="reason_for_deletion" class="form-control"> </textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> @lang('site.close') </button>
                <button type="submit" class="btn btn-primary"> @lang('site.send')  </button>
            </div>
        </form>

        </div>
    </div>
</div>
@endsection


@section('scripts')
  
@endsection