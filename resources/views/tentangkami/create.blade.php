@extends('layout.app')

@section('content')
    <div class="container col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex" style="align-items: center; justify-content: space-between">
                <h6 class="m-0 font-weight-bold text-primary">Create Tentang Kami</h6>
                <a class="btn btn-primary" href="{{ route('tentang-kami.index') }}">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('tentang-kami.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" id="title" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="visi" class="form-label">Visi:</label>
                                <textarea id="visi" name="visi" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="misi" class="form-label">Misi:</label>
                                <textarea id="misi" name="misi" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="banner" class="form-label">Banner (optional):</label>
                                <input type="file" id="banner" name="banner" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
