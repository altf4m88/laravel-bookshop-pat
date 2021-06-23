<div class="card card-primary card-outline mt-3">
    <div class="card-header">
        Input Pasok
    </div>
    <div class="card-body">
      
        <form action="{{url('/admin/input/create-supply')}}" method="post">
            @csrf
            <div class="form-group  mt-3">
                <h6 class="form-label">Pilih Distributor</h6>
                <select class="form-select"  name="distributor_id" required>
                    @foreach ($distributors as $distributor)
                        <option value="{{ $distributor->id_distributor }}">{{ $distributor->nama_distributor }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group  mt-3">
                <h6 class="form-label">Pilih Buku</h6>
                <select class="form-select"  name="book_id" required>
                    @foreach ($books as $book)
                        <option value="{{ $book->id_buku }}">{{ $book->judul}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group  mt-3">
                <h6 class="form-label">Jumlah</h6>
                <input type="number" id="jumlah" name="jumlah" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <h6 class="form-label">Tanggal</h6>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
        </form>
    </div>