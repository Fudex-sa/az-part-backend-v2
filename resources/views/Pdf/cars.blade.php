@extends('Pdf.layout')

@section('content')
    <div class=""><h3>
        @if($type == 'damaged') السيارات التالفة @else السيارات الأثرية @endif
    </h3></div>


    <table >
        <thead>
            <tr>
                <th> العنوان </th>
                <th> مالك السيارة   </th>
                <th> المودل </th>
                <th> اللون   </th>
                <th> الكيلومترات </th>
                <th> المدينة </th>
                <th> السعر   </th>                
                <th> ملاحظات </th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>            
                <td> {{ $row->title }} </td>
                <td> {{ $row->user['name'] }} </td>
                <td> {{ $row->brand['name'] .' - '. $row->model['name'] .' - '.$row->year }} </td>
                <td> {{ $row->color }} </td>
                <td> {{ $row->kilometers }} </td>
                <td> {{ $row->city['name'] }} </td>
                <td> {{ $row->price }} </td>
                <td> {{ $row->notes }} </td>                
            </tr>
        @endforeach
        </tbody>
</table>


@endsection
