@extends('layouts.app')
@section('content')
<h2>Admin Dashboard</h2>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>User</th>
    <th>Status</th>
    <th>Total Price</th>
    <th>Change Status</th>
</tr>
@foreach($orders as $order)
<tr>
    <td>{{ $order->Order_ID }}</td>
    <td>{{ $order->user->Name }}</td>
    <td>{{ $order->Order_Status }}</td>
    <td>${{ $order->Total_Price }}</td>
    <td>
        <form method="POST" action="{{ url('/admin/orders/'.$order->Order_ID.'/update') }}">
            @csrf
            <select name="Order_Status" class="form-control">
                <option {{ $order->Order_Status=='Pending'?'selected':'' }}>Pending</option>
                <option {{ $order->Order_Status=='In Progress'?'selected':'' }}>In Progress</option>
                <option {{ $order->Order_Status=='Completed'?'selected':'' }}>Completed</option>
                <option {{ $order->Order_Status=='Delivered'?'selected':'' }}>Delivered</option>
            </select>
            <button class="btn btn-success btn-sm mt-1">Update</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection
