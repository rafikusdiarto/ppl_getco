@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pencatatan Bahan Baku Pemilik Usaha</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Bahan Baku Pemilik Usaha</h6>
            </div>
            @role("Pemilik Usaha")
            <div class="card-header py-3">
                <a href="{{ route("pemilik-bahan-baku.create") }}"><button class="btn btn-success">+ Tambah Data Bahan Baku</button></a>
            </div>
            @endrole
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kuantiti</th>
                            <th>Updated_at</th>
                            @role("Pemilik Usaha")
                                <th>Aksi</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($bahan_bakus as $bahan_baku)
                                <tr>
                                    <td>{{ $bahan_baku->BahanBaku->name }}</td>
                                    <td>{{ $bahan_baku->quantity }}</td>
                                    <td>{{ $bahan_baku->updated_at->diffForhumans() }}</td>
                                    @role("Pemilik Usaha")
                                        <td class="d-flex">                                  
                                            <a href="{{ route("pemilik-bahan-baku.edit", $bahan_baku->id) }}">
                                                <button class="btn btn-warning">Edit</button>
                                            </a>
                                            <form method="POST" action="{{ route("pemilik-bahan-baku.destroy", $bahan_baku->id) }}">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    @endrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @if(session("success"))
        <script>
            Swal.fire("Sukses", `{{ session("success") }}`, "success");
        </script>
    @endif
@endsection
