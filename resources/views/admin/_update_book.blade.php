<div class="card card-primary card-outline mt-3">
    <div class="card-header">
        Edit Buku
    </div>
    <div class="card-body">
      
        <form action="{{url('/admin/input/book')}}" method="post">
            @method('PATCH')
            @csrf
            <input type="hidden" name="id_buku" value="{{$book->id_buku}}">
            <div class="form-group  mt-3">
                <h6 class="form-label">Judul Buku</h6>
                <input type="text" id="judul" name="judul" class="form-control" value="{{$book->judul}}">
            </div>
            <div class="form-group  mt-3">
                <h6 class="form-label">No ISBN</h6>
                <input type="text" id="noisbn" name="noisbn" class="form-control" value="{{$book->noisbn}}">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Penulis</h6>
                <input type="text" id="penulis" name="penulis" class="form-control"value="{{$book->penulis}}">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Penerbit</h6>
                <input type="text" id="penerbit" name="penerbit" class="form-control"value="{{$book->penerbit}}">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Tahun Terbit</h6>
                <input type="text" id="tahun" name="tahun" class="form-control"value="{{$book->tahun}}">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Harga Pokok</h6>
                <input type="text" id="harga_pokok" name="harga_pokok" class="form-control"value="{{$book->harga_pokok}}">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Harga Jual</h6>
                <input type="text" id="harga_jual" name="harga_jual" class="form-control"value="{{$book->harga_jual}}">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Diskon</h6>
                <input type="text" id="diskon" name="diskon" class="form-control"value="{{$book->diskon}}">
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
        </form>
    </div>