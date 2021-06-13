@extends('shared.header')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="card border-primary mb-3">
        <div class="card-header">Selamat Datang</div>
        <div class="card-body">
            <h4 class="card-title">Anda login sebagai {!! $userRole !!}</h4>
        </div>
    </div>
</div>

@endsection

@section('script')
 
@endsection