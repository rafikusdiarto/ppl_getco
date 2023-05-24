@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kalkulator Produksi</h1>
        <!-- DataTales Example -->


    </div>
    <!-- /.container-fluid -->
    @if(session("success"))
        <script>
            Swal.fire("Sukses", `{{ session("success") }}`, "success");
        </script>
    @endif

@endsection
