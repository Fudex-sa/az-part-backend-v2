@extends('Pdf.layout')

@section('content')
    <div class=""><h3>
        مزايدات السيارات
    </h3></div>


    <table >
        <thead>
            <tr>
                <th> السيارة </th>
                <th> مالك السيارة   </th>
                <th> صاحب المزايدة </th>
                <th> السعر   </th>
                <th> التعليق </th>
                <th> الحالة </th>
                <th> التاريخ   </th>                                
            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>            
                <td> {{ $row->car['title'] }} </td>
                <td> {{$row->car ? $row->car->user['name'] : ''}}</td>
                <td> {{ $row->user ? $row->user['name'] : '' }} 
                <td> {{ $row->price }} </td>
                <td> {{ $row->comment }} </td>
                <td>  @if($row->status == '1') Approve 
                      @elseif($row->status == '0') Reject
                      @else Pending @endif
                </td>
                <td> {{ $row->created_at }} </td>                
            </tr>
        @endforeach
        </tbody>
</table>


@endsection
