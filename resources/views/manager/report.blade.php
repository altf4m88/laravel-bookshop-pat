@extends('shared.header')

@section('title', 'Laporan')

@section('content')
<div class="d-flex h-100">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 25%; height: 100%;">
        <a href="/manager/report" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Laporan</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/manager/report/invoice" class="nav-link @if(Request::is('manager/report/invoice')) active @else text-white @endif" aria-current="page">
                    <span class="text-white mr-1"><i class="fas fa-receipt"></i></span>
                    Cetak Faktur
                </a>
            </li>
            <li>
                <a href="/manager/report/transactions" class="nav-link @if(Request::is('manager/report/transactions')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-file-invoice-dollar"></i></span>
                    Semua Penjualan
                </a>
            </li>
            <li>
                <a href="/manager/report/books-data" class="nav-link @if(Request::is('manager/report/books-data')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-book"></i></span>
                    Semua Data Buku
                </a>
            </li>
            <li>
                <a href="/manager/report/books-by-writer" class="nav-link @if(Request::is('manager/report/books-by-writer')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-address-book"></i></span>
                    Filter Penulis Buku
                </a>
            </li>
            <li>
                <a href="/manager/report/popular-books" class="nav-link @if(Request::is('manager/report/popular-books')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-atlas"></i></span>
                    Buku Yang Sering Terjual
                </a>
            </li>
            <li>
                <a href="/manager/report/unpopular-books" class="nav-link @if(Request::is('manager/report/unpopular-books')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-book-dead"></i></span>
                    Buku Yang Tidak Pernah Terjual
                </a>
            </li>
            <li>
                <a href="/manager/report/supply" class="nav-link @if(Request::is('manager/report/supply')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-boxes"></i></span>
                    Pasok Buku
                </a>
            </li>
            <li>
                <a href="/manager/report/supply-by-distributor" class="nav-link @if(Request::is('manager/report/supply-by-distributor')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-box"></i></span>
                    Filter Pasok Buku
                </a>
            </li>
        </ul>
        <hr>
    </div>
    <div class="container mt-3">
        @if(Request::is('manager/report'))
            <div class="card border-success mb-3">
                <div class="card-header">Laporan Manager</div>
                    <div class="card-body">
                    <h4 class="card-title">Laporan</h4>
                    <p class="card-text">Pilih salah satu menu di samping kiri.</p>
                </div>
            </div>
        @elseif(Request::is('manager/report/invoice'))
            @if(isset($action) && $action == 'SELECT')
                @include('manager._invoice_preview')
            @else
                @include('manager._print_invoice')
            @endif
        @elseif(Request::is('manager/report/transactions'))
            @include('manager._transactions')
        @elseif(Request::is('manager/report/supply-by-distributor'))
            @if($action == 'SELECT_DISTRIBUTOR')
                @include('manager._book_supply_by_distributor_form')
            @elseif($action == 'VIEW_DISTRIBUTOR')
                @include('manager._book_supply_by_distributor')
            @endif
        @elseif(Request::is('manager/report/supply'))
            @include('manager._book_supply')
        @elseif(Request::is('manager/report/books-data'))
            @include('manager._books_data')
        @elseif(Request::is('manager/report/books-by-writer'))
            @if($action == 'SELECT_WRITER')
                @include('manager._book_by_writer_form')
            @elseif($action == 'VIEW_WRITER')
                @include('manager._book_by_writer')
            @endif
        @elseif(Request::is('manager/report/popular-books'))
            @include('manager._popular_books')
        @elseif(Request::is('manager/report/unpopular-books'))
            @include('manager._unpopular_books')
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