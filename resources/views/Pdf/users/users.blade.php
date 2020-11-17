@extends('Pdf.layout')

@section('content')
    <div class=""> <h3>  المستخدمين </h3> </div>

    <table >
        <thead>
            <tr>
                <th> الإسم </th>
                <th> البريد الإلكترونى </th>
                <th> الجوال </th>
                <th> نوع المستخدم </th>
                <th> مفعل </th>
                <th> vip </th>
                <th> مجموع الطلبات </th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td> {{ $row->name }} </td>
                <td> {{ $row->email }} </td>
                <td> {{ $row->mobile }} </td>
                <td>
                    {{ $row->user_role == "company" ? 'شركة' : 'فرد' }}                    
                 </td>
                <td> {{ $row->active == 1 ? 'نعم' : 'لا' }} </td>
                <td> {{ $row->vip == 1 ? 'نعم' : 'لا' }} </td>
                <td> {{ $row->total_requests }} طلب </td>
            </tr>
        @endforeach
        </tbody>
</table>


@endsection
