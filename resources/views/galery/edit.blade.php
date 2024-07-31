@extends('layout.app')

@section('content')
    <div class="container col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex" style="align-items: center; justify-content: space-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Galery</h6>
                <a class="btn btn-primary" href="{{ route('galery.index') }}">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('galery.update', $galery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="classname" class="form-label">Classname:</label>
                                <select id="classname" name="classname" class="form-control" required>
                                    <option value="slower-1" {{ $galery->classname == 'slower-1' ? 'selected' : '' }}>slower-1</option>
                                    <option value="slower-2" {{ $galery->classname == 'slower-2' ? 'selected' : '' }}>slower-2</option>
                                    <option value="slower-3" {{ $galery->classname == 'slower-3' ? 'selected' : '' }}>slower-3</option>
                                    <option value="slower-4" {{ $galery->classname == 'slower-4' ? 'selected' : '' }}>slower-4</option>
                                    <option value="slower-5" {{ $galery->classname == 'slower-5' ? 'selected' : '' }}>slower-5</option>
                                    <option value="slower-6" {{ $galery->classname == 'slower-6' ? 'selected' : '' }}>slower-6</option>
                                    <option value="slower-7" {{ $galery->classname == 'slower-7' ? 'selected' : '' }}>slower-7</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Current Image:</label>
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $galery->image) }}" alt="Galery Image" class="img-fluid">
                                </div>
                                <label for="image" class="form-label">Change Image:</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
