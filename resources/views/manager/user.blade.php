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
        <div class="card border-info mb-3 col-9">
            <div class="card-header">
                Tambah User
            </div>
            <div class="card-body">
                <form action="{{ url('/manager/create-user') }}" method="POST">
                    @csrf
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-8 mt-3">
                        <div class="form-group">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-5 mt-3">
                        <div class="form-group">
                            <label for="phone" class="form-label">Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-5 mt-3">
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Sudah Menikah">Sudah Menikah</option>
                                <option value="Bujang">Bujang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-5 mt-3">
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 mt-3">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-5 mt-3">
                            <div class="form-group">
                                <label for="password-confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password-confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 mt-3">
                        <div class="form-group">
                            <label for="access" class="form-label">Hak Akses</label>
                            <select name="access" id="access" class="form-select" required>
                                <option value="KASIR">Kasir</option>
                                <option value="MANAGER">Manager</option>
                                <option value="ADMIN">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-info">
                            Tambah Akun
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