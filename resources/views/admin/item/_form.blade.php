@if (!empty($getRecord))
    <form action="{{ url('admin/item/edit/' . $getRecord->id) }}" method="post">
    @else
        <form action="{{ url('admin/item/add') }}" method="post">
@endif

{{ csrf_field() }}

<div class="row mb-3">
    <label class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="name" value="{{ old('name', $getRecord->name ?? '') }}" class="form-control"
            required>
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="category" value="{{ old('category', $getRecord->category ?? '') }}"
            class="form-control" required>
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-2 col-form-label">Specification</label>
    <div class="col-sm-10">
        <input type="text" name="specification" value="{{ old('specification', $getRecord->specification ?? '') }}"
            class="form-control">
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-2 col-form-label">Unit <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="unit" value="{{ old('unit', $getRecord->unit ?? '') }}" class="form-control"
            required placeholder="Contoh: pcs, box">
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-2 col-form-label">Stock</label>
    <div class="col-sm-10">
        <input type="number" name="stock" value="{{ old('stock', $getRecord->stock ?? 0) }}" class="form-control">
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
        <input type="number" name="price" value="{{ old('price', $getRecord->price ?? 0) }}" class="form-control">
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-10 offset-sm-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>

</form>
