@extends('dashboard.app')

@section('title') @lang('site.stock') @endsection

@section('styles')

@endsection


@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">

<div class="x_panel">

    <div class="x_content">

        <div class="table-responsive">
            @include('dashboard.stock.filter')
        </div>
    </div>
</div>

<div class="x_panel">
    <div class="x_title">
        <h2> @yield('title') </h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">

        <div class="table-responsive">

<div class="btn-group">

    <a class="btn btn-warning" data-toggle="modal" data-target=".add_item">
            <i class="fa fa-plus"></i>  @lang('site.add') </a>

            <a href="{{url('admin/export/stock/excel')}}" class="btn btn-sm btn-success">
                <i class="fa fa-download"></i> {{ __('site.excel') }}</a>

                <a href="{{url('admin/export/stock/pdf')}}" class="btn btn-sm btn-warning">
                <i class="fa fa-file"></i> {{ __('site.pdf') }}</a>

</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead class="text-primary">
        <tr>
            <th scope="col">#  </th>
            <th scope="col"> {{ __('site.brand') }}  </th>
            <th scope="col"> {{ __('site.model') }}  </th>
            <th scope="col"> {{ __('site.year') }}  </th>
            <th scope="col">{{ __('site.piece_name') }}</th>
            <th scope="col">{{ __('site.count_prices') }}</th>
            <th scope="col">{{ __('site.prices') }}</th>

      </tr>
      </thead>
      <tbody>
        @foreach($items as $k=>$item)
            <tr>
                <td>{{$k+1}}</td>

                <td> {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }} </td>

                <td> {{ $item->model ? $item->model['name_'.my_lang()] : '' }} </td>

                <td> {{ $item->year}} </td>

                <td>{{ $item->piece ? $item->piece['name_'.my_lang()] : ''}}</td>

                <td> {{ $item->count_price }} </td>

            <td> <a href="{{ route('admin.stock',
                    ['brand'=>$item->brand_id,'model'=>$item->model_id,'year'=>$item->year,'piece'=>$item->piece_id]) }}">
                    <i class="fa fa-eye"></i> @lang('site.view') </a> </td>


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

    @include('dashboard.stock.create')

@endsection

@section('scripts')

    @include('dashboard.ajax.load_models')

@endsection
