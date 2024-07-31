@extends('layout.app')

@section('content')
    <div class="container col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex" style="align-items: center; justify-content: space-between">
                <h6 class="m-0 font-weight-bold text-primary">Create Menu</h6>
                <a class="btn btn-primary" href="{{ route('menu.index') }}">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" id="title" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product" class="form-label">Products:</label>
                                <div id="product-list">
                                    <div class="input-group mb-2">
                                        <input type="text" name="product[]" class="form-control"
                                            placeholder="Enter product">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-product">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-product" class="btn btn-primary">Add Product</button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
