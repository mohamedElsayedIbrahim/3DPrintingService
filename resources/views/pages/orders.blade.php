@extends('layouts.app')

@section('title','طلباتي')

@section('content')

<section class="py-16">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg">

        <table class="w-full">
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                    <th>التكلفة</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->total_price }} جنيه</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</section>

@endsection
