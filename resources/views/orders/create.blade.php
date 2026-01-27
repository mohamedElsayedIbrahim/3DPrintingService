<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
</div>
@extends('layouts.app')

@section('title','طلب جديد')

@section('content')
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <input name="full_name" placeholder="الاسم الكامل">
    <input name="email" type="email">
    <button type="submit">إرسال</button>
</form>
@endsection
