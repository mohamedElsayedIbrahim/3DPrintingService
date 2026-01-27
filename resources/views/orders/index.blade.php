<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
</div>
@extends('layouts.app')

@section('content')

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>العميل</th>
            <th>الحالة</th>
            <th>التكلفة</th>
            <th>إجراء</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->full_name }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total_cost }} ريال</td>
                <td>
                    <form method="POST" action="{{ route('orders.destroy', $order) }}">
                        @csrf
                        @method('DELETE')
                        <button>حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection
