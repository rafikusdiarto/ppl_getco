@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kerja Sama</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Kerja Sama</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @role("Pemilik Usaha|Supplier")
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            
                            <thead>
                            <tr>
                                <th>Nama Mitra</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                <tr>
                                    @role("Pemilik Usaha")
                                        <td>{{ $request->KerjaSama->Supplier->name }}</td>
                                    @endrole
                                    @role("Supplier")
                                        <td>{{ $request->KerjaSama->PemilikUsaha->name }}</td>
                                    @endrole
                                    <td>{{ $request->SupplierBahanBaku->BahanBaku->name }}</td>
                                    <td>{{ $request->request }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection
