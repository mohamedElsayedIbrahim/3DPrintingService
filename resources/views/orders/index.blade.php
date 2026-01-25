@extends('layouts.app')
@section('content')
<h2>My Orders</h2>
<a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New Order</a>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Status</th>
    <th>Total Price</th>
    <th>Date</th>
    <th>Files</th>
</tr>
@foreach($orders as $order)
<tr>
    <td>{{ $order->Order_ID }}</td>
    <td>{{ $order->Order_Status }}</td>
    <td>${{ $order->Total_Price }}</td>
    <td>{{ $order->Order_Date }}</td>
    <td>
        @foreach($order->files as $file)
            <a href="{{ asset('storage/'.$file->File_Path) }}" target="_blank">{{ $file->File_Name }}</a><br>
        @endforeach
    </td>
</tr>
@endforeach
</table>
@endsection
