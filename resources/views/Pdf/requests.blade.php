@extends('Pdf.layout')

@section('content')
    <div class=""><h3>
        @if($type == 'normal') الطلبات العادية
        @elseif($type == "special") الطلبات المميزة
        @elseif($type == "admin") الطلبات المحولة للإدارة
         @endif
    </h3></div>


    <table >
        <thead>
            <tr>
                <th> رقم الطلب </th>
                <th>  الموديل     </th>
                <th> اسم القطعة </th>
                <th> العروض   </th>
                <th> حالة الطلب </th>
                <th> بتاريخ </th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td> AZ-{{ $row->id }} </td>
                <td> {{ $row->brand['name'] .' - '. $row->model['name'] .' - '.$row->year }} </td>
                <td> {{ $row->piece ? $row->piece['name'] : '' }} </td>
                <td> {{ count($row->offers) }} </td>
                <td> {{ $row->status }} </td>
                <td> {{ $row->created_at }} </td>
            </tr>
        @endforeach
        </tbody>
</table>


@endsection
