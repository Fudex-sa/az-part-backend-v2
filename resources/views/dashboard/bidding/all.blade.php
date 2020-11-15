@extends('dashboard.app')

@section('title') @lang('site.car_bidding') @endsection

@section('styles')

@endsection


@section('content')

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead>
    <tr class="headings">
        <th scope="col">#  </th>
        <th scope="col"> {{__('site.user')}}</th>
        <th scope="col">{{__('site.car')}}</th>
        <th scope="col">{{__('site.car_owner')}}</th>
        <th scope="col"> {{__('site.price')}}</th>
        <th scope="col"> {{__('site.status')}}</th>
        <th scope="col"> {{__('site.date')}}</th>
        <th scope="col"> </th>
        <th></th>
    </tr>
    </thead>

    <tbody>

        @foreach($items as $item)

           <tr>
               <td>{{$item->id}}</td>
               <td><a href="javascript:void(0);" data-toggle="modal" data-target="#bidderDetails{{$item->id}}">
                   {{$item->user ? $item->user['name'] : ''}} </a></td>
               <td>@if($item->car) <a href="{{url('car/'.$item->car['id'])}}" target="_blank">
                       {{$item->car['title']}} </a> @endif </td>
                <td><a href="javascript:void(0);" data-toggle="modal" data-target="#carOwnerDetails{{$item->id}}">
                   {{$item->car ? $item->car->user['name'] : ''}} </a></td>
               <td>{{$item->price}}</td>
               <td>
                   @if($item->status == '0')
                       <span class="label label-danger">@lang('site.reject')</span>
                   @elseif($item->status == '1')
                       <span class="label label-success">@lang('site.approved')</span>
                   @else
                       <span class="label label-info">@lang('site.pending')</span>
                   @endif
               </td>
               <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
               <td>
                   <a href="{{url('admin/bidding/approve/'.$item->id.'/'.'1')}}"> <i class="fa fa-thumbs-up"></i> </a>
                   <a href="{{url('admin/bidding/reject/'.$item->id.'/'.'0')}}"> <i class="fa fa-thumbs-down"></i> </a>

                   <a href="javascript:void(0);" data-toggle="modal" data-target="#editItem{{$item->id}}"><i class="fa fa-edit"></i> </a>
                   <a href="javascript:void(0);" itemid="{{$item->id}}" class="remove"><i class="fa fa-trash"></i> </a>
               </td>
           </tr>


           <div class="modal fade" id="bidderDetails{{$item->id}}" role="dialog">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                       </div>
           <div class="modal-body">

                   <div class="card ">
                       <div class="card-header card-header-primary">
                           <h4 class="card-title">{{ __('site.bidder_details') }}</h4>
                       </div>
                       <div class="card-body">

                           <div class="row">
                               <label class="col-sm-3 col-form-label">{{ __('site.name') }}</label>
                               <div class="col-sm-9">
                                   <div class="form-group">
                                       <input class="form-control" readonly type="text" value="{{$item->user['name']}}" />
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <label class="col-sm-3 col-form-label">{{ __('site.mobile') }}</label>
                               <div class="col-sm-9">
                                   <div class="form-group">
                                       <input class="form-control" readonly type="text" value="{{$item->user['mobile']}}" />
                                   </div>
                               </div>
                           </div>

                       </div>

                   </div>

           </div>

                   </div>
               </div>
           </div>



           <div class="modal fade" id="carOwnerDetails{{$item->id}}" role="dialog">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                       </div>
           <div class="modal-body">

                   <div class="card ">
                       <div class="card-header card-header-primary">
                           <h4 class="card-title">{{ __('site.car_owner_details') }}</h4>
                       </div>
                       <div class="card-body">

                           <div class="row">
                               <label class="col-sm-3 col-form-label">{{ __('site.name') }}</label>
                               <div class="col-sm-9">
                                   <div class="form-group">
                                       <input class="form-control" readonly type="text" value=" {{$item->car ? $item->car->user['name'] : ''}}" />
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <label class="col-sm-3 col-form-label">{{ __('site.mobile') }}</label>
                               <div class="col-sm-9">
                                   <div class="form-group">
                                       <input class="form-control" readonly type="text" value=" {{$item->car ? $item->car->user['mobile'] : ''}}" />
                                   </div>
                               </div>
                           </div>

                       </div>

                   </div>

           </div>

                   </div>
               </div>
           </div>


           <div class="modal fade" id="editItem{{$item->id}}" role="dialog">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                       </div>
                       <div class="modal-body">
                           <form class="mt-5" method="get" action="{{url('admin/bidding/update/'.$item->id)}}" id="form">
                               @csrf
                               <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
                               <div class="card ">
                                   <div class="card-header card-header-primary">
                                       <h4 class="card-title">{{ __('site.date_auction') }}</h4>
                                       <p class="card-category">{{ __('site.enter_the_below_required_data') }}</p>
                                   </div>
                                   <div class="card-body">


                                   @if(isset($item['car']->id))
                                       <input type="hidden" value="{{$item['car']->id}}" name="id" >
                                   @endif
                                       <div class="row">
                                           <label class="col-sm-3 col-form-label">{{ __('site.date_auction') }}</label>
                                           <div class="col-sm-9">
                                               <div class="form-group{{ $errors->has('date_auction') ? ' has-danger' : '' }}">
                                               @if(isset($item['car']->id))
                                                   <input class="form-control{{ $errors->has('date_auction') ? ' is-invalid' : '' }}" name="date_auction" id="date_auction"
                                                          type="datetime-local"  value="{{date('Y-m-d h:m:i', strtotime($item['car']->date_auction))}}" required="true" aria-required="true"/>

                                                   @if ($errors->has('date_auction'))
                                                       <span id="name-error" class="error text-danger" for="date_auction">{{ $errors->first('date_auction') }}</span>
                                                   @endif
                                               @endif
                                               </div>
                                           </div>
                                       </div>


                                   </div>
                                   <div class="card-footer ml-auto mr-auto">
                                       <button type="submit" class="btn btn-primary">{{ __('site.save') }}</button>
                                   </div>
                               </div>
                           </form>
                       </div>

                   </div>
               </div>
           </div>



   @endforeach

    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>


@endsection



@section('scripts')

    @include('dashboard.ajax.delete',['target'=>'bidding'])

    <script>
        $(".remove").click(function () {
            var _token = "{{ csrf_token() }}";
            var item = $(this).attr('itemid');
            if (confirm("{{ __('site.confirm_delete') }}")) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/bidding/delete') }}",
                    data: {_token: _token, item: item},
                    success: function (response) {
                        if(response == 1)
                        $.growl.notice({title: "Done",message: "{{ __('site.delete_success') }}"  });
                    }
                });
                var curtr = $(this).closest("tr");
                curtr.remove();
            }
        })
    </script>

@endsection
