@extends('Pdf.layout')

@section('content')
    <div class=""><h3>
           السيارات التى لدى التاجر
            ({{ $item->name }})
        </h3></div>


    <table >
        <thead>
        <tr>
            <th> الماركة </th>
            <th> الموديل </th>
            <th> السنة </th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
               <td> {{ $row->brand ? $row->brand['name'] : '' }} </td>
                <td> {{ $row->model ? $row->model['name'] : '' }} </td>
                <td>
                    @if($row->year)
                        @foreach($row->year as $year)
                            {{ $year }} - 
                        @endforeach
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
