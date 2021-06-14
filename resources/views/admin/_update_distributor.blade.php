<div class="card card-primary card-outline mt-3">
    <div class="card-header">
        Edit Data Distributor
    </div>
    <div class="card-body">
        <form action="{{url('/admin/input/distributor')}}" method="post">
            @method('PATCH')
            @csrf
            <input type="hidden" name="id_distributor" value="{{$distributor->id_distributor}}">
            <div class="form-group mt-3">
                <h6 class="form-label">Nama Distributor</h6>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ $distributor->nama_distributor }}">
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Alamat</h6>
                <textarea name="alamat" id="alamat" class="form-control"> {{ $distributor->alamat }} </textarea>
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Telepon</h6>
                <input type="text" id="telepon" name="telepon" class="form-control" value="{{ $distributor->telepon }}">
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </div>
        </form>
      
    </div>
  </div>