<div class="container">
    <div class="card text-center mt-5">
        <div class="card-header">
            LAPORAN PASOK BERDASARKAN DISTRIBUTOR
        </div>
        <div class="card-body">
            <h5 class="card-title">Distributor : {{ $distributor['nama_distributor'] }}</h5>
            <p class="card-text">Tanggal Cetak : {{ $time }}</p>
            <div class="table-responsive">
                <table class=" table table-hover table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>NO ISBN</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Jumlah Pasok</th>
                        <th>Tanggal</th>
                    </thead>
                    <tbody>
                        @foreach ($supplies as $book)    
                        @if(!isset($supply['book']))
                            @continue
                        @endif
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book['book']['judul']}}</td>
                            <td>{{ $book['book']['noisbn']}}</td>
                            <td>{{ $book['book']['penulis']}}</td>
                            <td>{{ $book['book']['penerbit']}}</td>
                            <td>{{ $book['book']['harga_jual']}}</td>
                            <td>{{ $book['book']['stok']}}</td>
                            <td>{{ $book['jumlah']}}</td>
                            <td>{{ $book['tanggal']}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td><span class="text-bold font-weight-bold">Jumlah</span></td>
                            <td colspan="8"><span class="text-bold font-weight-bold text-center">{{ $bookCount }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>