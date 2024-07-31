@extends('layout.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">RUMAH MAKAN DASHBOARD</h6>
                </div>
                <div class="card-body">
                    <p>Selamat Datang Admin, Ulasan Rumah Makan Pagar Alam siap dikelola</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Data Ulasan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ulasans->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="display: flex; align-items: center; justify-content: space-between">
            <h6 class="m-0 font-weight-bold text-primary">Ulasan DataTables</h6>
            <a href="{{route('ulasan.create')}}" class="btn btn-primary">Create</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Deskripsi</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Deskripsi</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($ulasans as $ulasan)
                            <tr>
                                <td>{{ $ulasan->name }}</td>
                                <td>{{ $ulasan->deskripsi }}</td>
                                <td>{{ $ulasan->email }}</td>
                                <td>
                                    <a href="{{ route('ulasan.edit', $ulasan->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('ulasan.destroy', $ulasan->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
