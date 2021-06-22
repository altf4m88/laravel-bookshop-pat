<div class="card mt-3">
    <div class="card-body">
        <h3>Form Input Buku</h3>
        <a href="/admin/input/create-book" class="btn btn-success">Tambah Data</a>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Judul</th>
                        <th scope="col">No ISBN</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Harga Pokok</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{$book->id_buku}}</td>
                        <td>{{$book->judul}}</td>
                        <td>{{$book->noisbn}}</td>
                        <td>{{$book->penulis}}</td>
                        <td>{{$book->penerbit}}</td>
                        <td>{{$book->tahun}}</td>
                        <td>{{$book->harga_pokok}}</td>
                        <td>{{$book->harga_jual}}</td>
                        <td>{{$book->diskon}}%</td>
                        <td>
                            <a href="{{url('admin/input/'.$book->id_buku.'/update-book')}}"><i class="far fa-edit"></i></a> | 
                            <a href="{{url('admin/input/'.$book->id_buku.'/delete-book')}}"><i class="fas fa-trash-alt" style="color: red;"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>