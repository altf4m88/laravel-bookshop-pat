<div class="card card-primary card-outline mt-3">
    <div class="card-header">
        Tambah Buku
    </div>
    <div class="card-body">
      
        <form action="{{url('/admin/input/book')}}" method="post">
            @csrf
            <div class="form-group  mt-3">
                <h6 class="form-label">Judul Buku</h6>
                <input type="text" id="judul" name="judul" class="form-control" >
            </div>
            <div class="form-group  mt-3">
                <h6 class="form-label">No ISBN</h6>
                <input type="text" id="noisbn" name="noisbn" class="form-control" >
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Penulis</h6>
                <input type="text" id="penulis" name="penulis" class="form-control">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Penerbit</h6>
                <input type="text" id="penerbit" name="penerbit" class="form-control">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Tahun Terbit</h6>
                <input type="text" id="tahun" name="tahun" class="form-control">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Harga Pokok</h6>
                <input type="text" id="harga_pokok" name="harga_pokok" class="form-control">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Harga Jual</h6>
                <input type="text" id="harga_jual" name="harga_jual" class="form-control">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Diskon</h6>
                <input type="text" id="diskon" name="diskon" class="form-control">
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
        </form>
    </div>