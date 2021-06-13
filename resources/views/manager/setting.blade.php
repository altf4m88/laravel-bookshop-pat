@extends('shared.header')

@section('title', 'User')

@section('content')

<div class="h-100">
    <div class="container">
        @if(\Session::has('success'))
        <div class="alert alert-dismissible alert-success mt-4" id="alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>{!! \Session::get('success') !!}</strong>
        </div>
        @elseif(\Session::has('failed'))
        <div class="alert alert-dismissible alert-danger mt-4" id="alert-failed">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>{!! \Session::get('failed') !!}</strong>
        </div>
        @endif
    </div>
    <div class="container-sm d-flex mt-3 justify-content-center">
        <div class="card border-success mb-3 col-9">
            <div class="card-header">
                Setting Laporan
            </div>
            <div class="card-body">
                <form action="{{ url('/manager/update-profile') }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" name="id-setting" value="{{$profile->id_setting}}">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$profile->nama_perusahaan}}" required>
                        </div>
                    </div>
                    <div class="col-8 mt-3">
                        <div class="form-group">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control" required>{!!$profile->alamat!!}</textarea>
                        </div>
                    </div>
                    <div class="col-5 mt-3">
                        <div class="form-group">
                            <label for="phone" class="form-label">No Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{$profile->no_tlpn}}" required>
                        </div>
                    </div>
                    <div class="col-5 mt-3">
                        <div class="form-group">
                            <label for="handphone" class="form-label">No Handphone</label>
                            <input type="text" name="handphone" id="handphone" class="form-control" value="{{$profile->no_hp}}" required>
                        </div>
                    </div>
                    <div class="col-5 mt-3">
                        <div class="form-group">
                            <label for="web" class="form-label">Web</label>
                            <input type="text" name="web" id="web" class="form-control" value="{{$profile->web}}" required>
                        </div>
                    </div>
                    <div class="col-5 mt-3">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{$profile->email}}" required>
                        </div>
                    </div>
                    <div class="col-5 mt-1">
                        <div class="form-group">
                            <label for="form-file" class="form-label mt-4">Logo Laporan</label>
                            <div class="row">
                                <div class="col">
                                    <input class="form-control" type="file" id="form-file" name="file">
                                </div>
                                <div class="col-1">
                                    <img src="{{ url('/images/'.$profile->logo) }}" alt="logo" class="" width="50px" height="50px">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('.btn-close').on('click', (e) => {
            $('#alert-success').addClass('d-none');
            $('#alert-failed').addClass('d-none');
        })
    </script>   
@endsection