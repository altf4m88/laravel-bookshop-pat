@extends('shared.header')

@section('title', 'Laporan')

@section('content')
<div class="d-flex h-100">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 25%; height: 60rem !important;">
        <a href="/admin/report" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Laporan</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="/admin/report/books" class="nav-link @if(Request::is('admin/report/books')) active @else text-white @endif" aria-current="page">
              <span class="text-white mr-1"><i class="fas fa-book"></i></span>
              Semua Data Buku
            </a>
          </li>
          <li>
            <a href="/admin/report/books-by-writer" class="nav-link @if(Request::is('admin/report/books-by-writer')) active @else text-white @endif">
              <span class="text-white mr-1"><i class="fas fa-address-book"></i></span>
              Filter Penulis Buku
            </a>
          </li>
          <li>
            <a href="/admin/report/popular-books" class="nav-link @if(Request::is('admin/report/popular-books')) active @else text-white @endif">
              <span class="text-white mr-1"><i class="fas fa-atlas"></i></span>
              Buku Yang Sering Terjual
            </a>
          </li>
          <li>
            <a href="/admin/report/unpopular-books" class="nav-link @if(Request::is('admin/report/unpopular-books')) active @else text-white @endif">
              <span class="text-white mr-1"><i class="fas fa-book-dead"></i></span>
              Buku yang Tidak Pernah Terjual
            </a>
          </li>
          <li>
            <a href="/admin/report/books-supply" class="nav-link @if(Request::is('admin/report/books-supply')) active @else text-white @endif">
              <span class="text-white mr-1"><i class="fas fa-boxes"></i></span>
              Pasok Buku
            </a>
          </li>
          <li>
            <a href="/admin/report/books-supply-filter" class="nav-link @if(Request::is('admin/report/books-supply-filter')) active @else text-white @endif">
              <span class="text-white mr-1"><i class="fas fa-box"></i></span>
              Filter Pasok Buku
            </a>
          </li>
        </ul>
        <hr>
      </div>
      <div class="container mt-3">

        @if(Request::is('admin/report'))
          <div class="card border-success mb-3">
            <div class="card-header">Laporan Admin</div>
                <div class="card-body">
                <h4 class="card-title">Laporan</h4>
                <p class="card-text">Pilih salah satu menu di samping kiri.</p>
            </div>
          </div>
        @elseif(Request::is('admin/report/books'))
            @include('admin._book')
        @elseif(Request::is('admin/report/books-by-writer'))
            @if($action == 'SELECT_WRITER')
              @include('admin._book_by_writer_form')
            @elseif($action == 'VIEW_WRITER')
              @include('admin._book_by_writer')
            @endif
        @elseif(Request::is('admin/report/popular-books'))
            @include('admin._popular_books')
        @elseif(Request::is('admin/report/unpopular-books'))
            @include('admin._unpopular_books')
        @elseif(Request::is('admin/report/books-supply'))
            @include('admin._book_supply')
        @elseif(Request::is('admin/report/books-supply-filter'))
            @if($action == 'SELECT_DISTRIBUTOR')
              @include('admin._book_supply_by_distributor_form')
            @elseif($action == 'VIEW_DISTRIBUTOR')
              @include('admin._book_supply_by_distributor')
            @endif
        @endif
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