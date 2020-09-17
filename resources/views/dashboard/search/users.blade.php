@extends('dashboard.layouts.app')

@section('title') @lang('site.the_search') @endsection

@section('styles')
    
@endsection


@section('content')
   
<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead>
    <tr class="headings">
        <th>#  </th>
        <th> @lang('site.user_id')</th>
        <th> @lang('site.name')   </th>
        <th> @lang('site.user_role')  </th>
        <th> @lang('site.requests_count')  </th>
        <th> @lang('site.rule') </th>        
        <th> @lang('site.vip') </th>
        <th> @lang('site.active') </th>
        <th> @lang('site.registered_date') </th>
        <th></th>
    </tr>
    </thead>

    <tbody>
        
        @foreach($items as $k=>$item)

        <tr class="even pointer">
          
            <td>{{ $k+1 }}</td>

            <td>user#{{$item->id}}</td>
            
            <td>{{$item->name}}</td>
            
            <td><span class="label label-{{$item->user_role}}"> {{ __('site.'.$item->user_role) }}</span></td>
            
            <td> {{ $item->total_requests }} @lang('site.request') </td>

            <td>{{ $item->rule ? $item->rule->name : '-' }}</td>
 

            <td>
                @if($item->vip ==1) <button class="btn btn-success btn-xs">
                         <i class="fa fa-check"></i> @lang('site.yes') </button>
                @else
                    <button class="btn btn-warning btn-xs">
                    <i class="fa fa-close"></i> @lang('site.no') </button>
                @endif 
            </td>

            <td>
                @if($item->active ==1) <button class="btn btn-success btn-xs">
                    <i class="fa fa-check"></i> @lang('site.yes') </button>
                @else
                    <button class="btn btn-warning btn-xs">
                    <i class="fa fa-close"></i> @lang('site.no') </button>
                @endif     
            </td>
          
            <td> {{ $item->created_at }} </td>
    
            <td>
                <a class="whatsapp btn btn-success btn-xs" target="_blank" href="https://wa.me/966{{$item->mobile}}?text=
                {{ \App\Models\Setting::getvalue('whatsapp_msg') }}">
                <i class="fa fa-whatsapp"></i>
                </a>

                <a href="{{ route('admin.user.edit',$item->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </a>

                <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
            </td>
        </tr>
           
        @endforeach
        
    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>
 

@endsection



@section('scripts')
    @include('dashboard.layouts.message') 

    @include('dashboard.ajax.delete',['target'=>'user']) 

    {{-- @include('dashboard.ajax.export_excel',['fileName'=>'users'])  --}}
     
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
    <script>
        var doc = new jsPDF('p', 'pt');
        var elem = document.getElementById("myTbl");
        var res = doc.autoTableHtmlToJson(elem);

        doc.autoTable(res.columns, res.data, {styles: {font: "Amiri"}});

        // doc.autoTable(res.columns, res.data);
        doc.save("table.pdf");
    </script> --}}

   
@endsection
