@extends('Pdf.layout')

@section('content')
    <div class=""><h3>
        سوق البورصة
    </h3></div>


    <table >
        <thead>
            <tr>
                <th> الموديل </th>
                <th> اسم القطعة     </th>
                <th> الأسعار   </th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td> {{ $row->brand['name'] . ' - ' . $row->model['name'] .' - ' . $row->year }}</td>
                <td> {{ $row->piece['name'] }}                 
                <td>  @foreach($row->movements as $movment)
                        {{ $movment->price }} SR  -
                      @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
</table>


@endsection
