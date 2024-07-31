@extends('layout.app')

@section('content')
    <div class="container col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex" style="align-items: center; justify-content: space-between">
                <h6 class="m-0 font-weight-bold text-primary">Create Galery</h6>
                <a class="btn btn-primary" href="{{ route('galery.index') }}">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('galery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="classname" class="form-label">Classname:</label>
                                <select id="classname" name="classname" class="form-control" required>
                                    <option value="slower-1">slower-1</option>
                                    <option value="slower-2">slower-2</option>
                                    <option value="slower-3">slower-3</option>
                                    <option value="slower-4">slower-4</option>
                                    <option value="slower-5">slower-5</option>
                                    <option value="slower-6">slower-6</option>
                                    <option value="slower-7">slower-7</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
