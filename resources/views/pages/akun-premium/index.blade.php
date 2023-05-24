@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Akun Premium</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Akun Premium</h6>
            </div>
            @role("Admin")
            <div class="card-header py-3">
                <a href="{{ route("create-akun-premium") }}"><button class="btn btn-success">+ Tambah Akun Premium</button></a>
            </div>
            @endrole
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No. Rekening</th>
                            <th>Tanggal Bayar</th>
                            <th>Expired Date</th>
                            <th>Status</th>
                            @role("Admin")
                                <th>Aksi</th>
                            @endrole
                        </tr>
                        </thead>
                        {{-- <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Kuantiti</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            @role("Supplier")
                                <th>Aksi</th>
                            @endrole
                        </tr>
                        </tfoot> --}}
                        <tbody>
                            @foreach ($getAkunPremium as $info)
                                <tr>
                                    <td>{{ $info->nama }}</td>
                                    <td>{{ $info->no_rek}}</td>
                                    <td>{{ $info->tanggal_bayar }}</td>
                                    <td>{{ $info->expired_date }}</td>
                                    <td>Active</td>
                                    @role("Admin")
                                        <td class="d-flex">
                                            <form action="{{ route("edit-akun-premium", $info->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-warning">Edit</button>
                                            </form>
                                            <form method="POST" action="{{ route("supplier-bahan-baku.destroy", $info->id) }}">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger ">Hapus</button>
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
