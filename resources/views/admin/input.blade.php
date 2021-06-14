@extends('shared.header')

@section('title', 'Input')

@section('content')
<div class="d-flex">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 25%; height: 60rem !important;">
        <a href="/admin/input" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Input</span>
        </a>
        <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/admin/input/distributor" class="nav-link @if(Request::is('admin/input/distributor')) active @else text-white @endif" aria-current="page">
                    <span class="text-white mr-1"><i class="fas fa-address-book"></i></span>
                    Input Distributor
                    </a>
                </li>
                <li>
                    <a href="/admin/input/book" class="nav-link @if(Request::is('admin/input/book')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-book"></i></span>
                    Input Buku
                    </a>
                </li>
                <li>
                    <a href="/admin/input/supply" class="nav-link @if(Request::is('admin/input/supply')) active @else text-white @endif">
                    <span class="text-white mr-1"><i class="fas fa-boxes"></i></span>
                    Input Pasok Buku
                    </a>
                </li>
            </ul>
        <hr>
    </div>
    <div class="container mt-3">
        @if(Request::is('admin/input'))
            utama
        @elseif(Request::is('admin/input/distributor'))
            @include('admin._distributor')
        @elseif(Request::is('admin/input/book'))
            @include('admin._book')
        @elseif(Request::is('admin/input/supply'))
            @include('admin._supply')
        @elseif(Request::is('admin/input/create-distributor'))
            @include('admin._create_distributor')
        @endif

        @if (isset($action) && isset($distributor) && $action == 'UPDATE')
            @include('admin._update_distributor')
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