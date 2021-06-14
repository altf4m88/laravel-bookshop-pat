@extends('shared.header')

@section('title', 'Laporan')

@section('content')
<div class="d-flex h-100">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 25%; height: 100%;">
        <a href="/admin/laporan" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Laporan</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
              Semua Data Buku
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
              Filter Penulis Buku
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
              Buku Yang Sering Terjual
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
              Buku yang Tidak Pernah Terjual
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
              Pasok Buku
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
              Filter Pasok Buku
            </a>
          </li>
        </ul>
        <hr>
      </div>
      <div class="container mt-3">
        <div class="card border-primary mb-3">
            <div class="card-header">Selamat Datang</div>
            <div class="card-body">
                <h4 class="card-title">INI HALAMAN Laporan</h4>
            </div>
        </div>
      </div>
</div>
@endsection

@section('script')
    <script>
        function test(){
            console.log($('#element-asu').data());

        }
    </script>   
@endsection