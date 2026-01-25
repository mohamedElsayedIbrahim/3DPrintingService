@extends('layouts.app')
@section('content')
<h2>Create New Order</h2>
<form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Upload 3D Files</label>
        <input type="file" name="files[]" multiple class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Material</label>
        <select name="Material_ID" class="form-control">
            @foreach(App\Models\Material::all() as $material)
            <option value="{{ $material->Material_ID }}">{{ $material->Name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Color</label>
        <input type="text" name="Color" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Quality</label>
        <select name="Quality" class="form-control">
            <option>Low</option>
            <option>Medium</option>
            <option>High</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="Quantity" class="form-control" min="1" required>
    </div>
    <button class="btn btn-success">Create Order</button>
</form>
@endsection
