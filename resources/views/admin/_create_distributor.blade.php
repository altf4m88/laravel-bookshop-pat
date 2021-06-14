<div class="card card-primary card-outline mt-3">
    <div class="card-header">
        Tambah Data Distributor
    </div>
    <div class="card-body">
        <form action="{{url('/admin/input/distributor')}}" method="post">
            @csrf
            <div class="form-group mt-3">
                <h6 class="form-label">Nama Distributor</h6>
                <input type="text" id="nama" name="nama" class="form-control" >
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Alamat</h6>
                <textarea name="alamat" id="alamat" class="form-control"></textarea>
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Telepon</h6>
                <input type="text" id="telepon" name="telepon" class="form-control">
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
        </form>
    </div>
</div>