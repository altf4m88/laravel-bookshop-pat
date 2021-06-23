@extends('shared.header')

@section('title', 'Laporan')

@section('content')
<div class="d-flex h-100">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 25%; height: 60rem !important;">
        <a href="/cashier/report" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Laporan</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="/cashier/report/print-invoice" class="nav-link @if(Request::is('cashier/report/print-invoice')) active @else text-white @endif" aria-current="page">
              <span class="text-white mr-1"><i class="fas fa-receipt"></i></span>
              Cetak Faktur
            </a>
          </li>
          <li>
            <a href="/cashier/report/all-transactions" class="nav-link @if(Request::is('cashier/report/all-transactions')) active @else text-white @endif">
              <span class="text-white mr-1"><i class="fas fa-file-invoice-dollar"></i></span>
              Semua Penjualan
            </a>
          </li>
        </ul>
        <hr>
      </div>
      <div class="container mt-3">

        @if(Request::is('cashier/report'))
        <div class="card border-success mb-3">
          <div class="card-header">Laporan Kasir</div>
              <div class="card-body">
              <h4 class="card-title">Laporan</h4>
              <p class="card-text">Pilih salah satu menu di samping kiri.</p>
          </div>
        </div>
        @elseif(Request::is('cashier/report/print-invoice'))
            @if(isset($action) && $action == 'SELECT')
              @include('kasir.select_invoice')
            @else
              @include('kasir.invoice')
            @endif
        @elseif(Request::is('cashier/report/all-transactions'))
            @include('kasir.all_transaction')
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