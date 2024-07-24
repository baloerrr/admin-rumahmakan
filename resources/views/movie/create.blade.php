@extends('layout.app')

@section('content')
    <div class="container col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex " style="align-items: center; justify-content: space-between">
                <h6 class="m-0 font-weight-bold text-primary">Create Data</h6>
                <a class="btn btn-primary" href="{{route('movie.index')}}">Back </a>
            </div>
            <div class="card-body">
                <form action="{{ route('movie.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul:</label>
                                <input type="text" id="judul" name="judul" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="banner" class="form-label">Banner:</label>
                                <input type="file" id="banner" name="banner" class="form-control" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="video" class="form-label">Video:</label>
                                <input type="file" id="video" name="video" class="form-control" accept="video/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipe" class="form-label">Tipe:</label>
                                <input type="text" id="tipe" name="tipe" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="desk" class="form-label">Deskripsi:</label>
                                <textarea id="desk" name="desk" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
