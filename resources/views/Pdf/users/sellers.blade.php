@extends('Pdf.layout')

@section('content')
    <div class=""> <h3>  التجار والوسائط </h3> </div>

    <table >
        <thead>
            <tr>
                <th> الإسم </th>
                <th> البريد الإلكترونى </th>
                <th> الجوال </th>
                <th> نوع المستخدم </th>
                <th> مفعل </th>
                <th> vip </th>                
            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td> {{ $row->name }} </td>
                <td> {{ $row->email }} </td>
                <td> {{ $row->mobile }} </td>
                <td>
                    @if($row->user_role == "seller_tashalih") تشليح
                    @elseif($row->user_role == "seller_manufacturing") تاجر قطع غيار
                    @else وسيط @endif
                 </td>
                <td> {{ $row->active == 1 ? 'نعم' : 'لا' }} </td>
                <td> {{ $row->vip == 1 ? 'نعم' : 'لا' }} </td>                
            </tr>
        @endforeach
        </tbody>
</table>


@endsection
