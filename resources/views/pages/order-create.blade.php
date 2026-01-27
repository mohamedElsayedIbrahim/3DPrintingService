@extends('layouts.app')

@section('title','طلب جديد')

@section('content')

<section id="order" class="py-16">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">

        <h2 class="text-3xl font-bold text-center mb-8">طلب جديد</h2>

        <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="full_name" required>
    <input type="email" name="email" required>
    <input type="text" name="phone" required>
    <input type="text" name="city">

    <textarea name="project_description" required></textarea>

    <select name="material">
        <option value="PLA">PLA</option>
        <option value="ABS">ABS</option>
        <option value="PETG">PETG</option>
        <option value="Resin">Resin</option>
    </select>

    <input type="number" name="quantity" value="1" min="1">

    <input type="date" name="delivery_date">

    <textarea name="notes"></textarea>

    <input type="file" name="design_file" required>

    <button type="submit">إرسال الطلب</button>
</form>

    </div>
</section>

@endsection
