@extends('dashboard.app')

@section('title') @lang('site.damaged_cars') @endsection

@section('styles')

@endsection


@section('content')

<a href="{{url('admin/export/cars/excel/damaged')}}" class="btn btn-sm btn-success">
                 <i class="fa fa-download"></i> {{ __('site.excel') }}</a>

                 <a href="{{url('admin/export/cars/pdf/damaged')}}" class="btn btn-sm btn-warning">
                 <i class="fa fa-file"></i> {{ __('site.pdf') }}</a>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead>
        <tr>
            <th scope="col">#  </th>
            <th scope="col" style="width: 100px;"> <i class="fa fa-camera"></i> </th>
            <th scope="col"> {{__('site.title')}}</th>
            <th scope="col"> {{__('site.model')}}</th>
            <th scope="col"> {{__('site.price')}}</th>
            <th scope="col">{{__('site.owner')}}</th>
            <th scope="col"> {{__('site.views')}}</th>
            <th scope="col"> {{__('site.date')}}</th>
            <th scope="col"> {{__('site.comments')}}</th>
            <th scope="col"> </th>
          </tr>
    </thead>

    <tbody>

        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>

            <td>
                @if(count($item->imgs) > 0)
                  <img src="{{ img_path($item->imgs[0]->photo) }}" alt="" class="img-tbl">
                @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-tbl"> @endif
            </td>

            <td><a href="{{ route('car',$item->id) }}" target="_blank"> {{ $item->title }} </a></td>

            <td>{{ $item->brand ? $item->brand['name_'.my_lang()] : '' }} -
                {{ $item->model ? $item->model['name_'.my_lang()] : '' }} -
                {{$item->year}}
            </td>

            <td>{{ $item->price_type == 'fixed' ? $item->price . __('site.rs') : ''}} </td>

            <td>{{ $item->user ? $item->user['name'] : ''}}</td>

            <td>{{ $item->views }}</td>

            <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>

            <td><a href="{{ route('admin.car.comments',$item->id) }}">
                <i class="fa fa-comment"></i> {{ $item->comments->count() }}</a></td>

            <td>
                <a href="{{ route('admin.car',$item->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </a>

                <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>

            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>


@endsection



@section('scripts')

    @include('dashboard.ajax.delete',['target'=>'car'])


@endsection
