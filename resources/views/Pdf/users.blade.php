@extends('Pdf.layout')

@section('content')
    <div class=""><h3>
        @if($type == 'seller_broker')  التجار والوسائط @elseif($type == 'supervisor')
        المشرفين @else المستخدمين @endif
    </h3></div>


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
                    @if($row->user_role == "company") شركة
                    @elseif($row->user_role == "supervisor") مشرف
                    @elseif($row->user_role == "admin") مدير
                    @elseif($row->user_role == "seller_tashalih") تشاليح
                    @elseif($row->user_role == "seller_manufacturing") صناعية
                    @elseif($row->user_role == "mediator") وسيط
                    @else فرد @endif
                 </td>
                <td> @if($row->active == 1) نعم @else ﻻ @endif </td>
                <td> @if($row->vip == 1) نعم @else ﻻ @endif </td>
                <td> {{ $row->total_requests }} طلب </td>
            </tr>
        @endforeach
        </tbody>
</table>


@endsection
