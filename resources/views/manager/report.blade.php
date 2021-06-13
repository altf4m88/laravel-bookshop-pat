@extends('shared.header')

@section('title', 'Laporan')

@section('content')
<div class="d-flex h-100">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 25%; height: 100%;">
        <a href="/manager/laporan" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Laporan</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/manager/laporan/invoice" class="nav-link @if(Request::is('manager/laporan/invoice')) active @else text-white @endif" aria-current="page">
                    <span class="text-white mr-1"><i class="fas fa-receipt"></i></span>
                    Cetak Faktur
                </a>
            </li>
            <li>
                <a href="/manager/laporan/all-sales" class="nav-link @if(Request::is('manager/laporan/all-sales')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-file-invoice-dollar"></i></span>
                    Semua Penjualan
                </a>
            </li>
            <li>
                <a href="/manager/laporan/sales-by-date" class="nav-link @if(Request::is('manager/laporan/sales-by-date')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-calendar-day"></i></span>
                    Penjualan Pertanggal
                </a>
            </li>
            <li>
                <a href="/manager/laporan/books-data" class="nav-link @if(Request::is('manager/laporan/books-data')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-book"></i></span>
                    Semua Data Buku
                </a>
            </li>
            <li>
                <a href="/manager/laporan/books-by-writer" class="nav-link @if(Request::is('manager/laporan/books-by-writer')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-address-book"></i></span>
                    Filter Penulis Buku
                </a>
            </li>
            <li>
                <a href="/manager/laporan/popular-books" class="nav-link @if(Request::is('manager/laporan/popular-books')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-atlas"></i></span>
                    Buku Yang Sering Terjual
                </a>
            </li>
            <li>
                <a href="/manager/laporan/unpopular-books" class="nav-link @if(Request::is('manager/laporan/unpopular-books')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-book-dead"></i></span>
                    Buku Yang Tidak PernahTerjual
                </a>
            </li>
            <li>
                <a href="/manager/laporan/supply" class="nav-link @if(Request::is('manager/laporan/supply')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-boxes"></i></span>
                    Pasok Buku
                </a>
            </li>
            <li>
                <a href="/manager/laporan/supply-by-distributor" class="nav-link @if(Request::is('manager/laporan/supply-by-distributor')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-box"></i></span>
                    Filter Pasok Buku
                </a>
            </li>
        </ul>
        <hr>
    </div>
    <div class="container mt-3">
        @if(Request::is('manager/laporan'))
            utama
        @elseif(Request::is('manager/laporan/invoice'))
            invoice
        @elseif(Request::is('manager/laporan/all-sales'))
            sales
        @elseif(Request::is('manager/laporan/supply-by-distributor'))
            supply
        @elseif(Request::is('manager/laporan/supply'))
                supply-2
        @elseif(Request::is('manager/laporan/books-data'))
            booksdata
        @elseif(Request::is('manager/laporan/books-by-writer'))
            writer
        @elseif(Request::is('manager/laporan/popular-books'))
            popular
        @elseif(Request::is('manager/laporan/unpopular-books'))
            unpopular
        @elseif(Request::is('manager/laporan/sales-by-date'))
            sales by date
        @endif
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