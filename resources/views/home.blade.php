@extends('shared.header')

@section('title', 'Home')

@section('content')
<div class="container mt-3">
    <div class="card border-primary mb-3">
        <div class="card-header bg-primary text-white">Selamat Datang</div>
        <div class="card-body">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('/images/'.$profile->logo)}}" alt="" class="w-25 img-thumbnail">
                <h3>{{$profile->nama_perusahaan}}</h3>
                <h4>{{$profile->alamat}}</h4>
                <h4 class="text-success text-decoration-underline">{{$profile->web}}</h4>
                <h4 class="card-title">Anda login sebagai {!! ucwords(strtolower($userRole)) !!}</h4>
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('script')
 
@endsection