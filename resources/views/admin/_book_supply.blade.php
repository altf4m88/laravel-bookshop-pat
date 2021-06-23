<div class="form-group form-inline text-right">
    <div class="clearfix"></div>
    <div class="controls">
        <form action="{{url('/admin/report/books-supply')}}" method="post" class=" myform form-group form-inline">
            @csrf
            <label>Periode :</label>
            <select name="date" id="tanggal" class="tcal form-control tcalInput">
                @foreach ($dates as $date)
                <option value="{{$date}}">{{$date}}</option>
                @endforeach
            </select>
            <br>
            <button type="submit" name="btnTampil" class="form-group btn btn-info" >Tampilkan</button>
            <a type="button" href="{{url('/admin/report/books-supply')}}" class="form-group btn btn-primary">Refresh</a>
            <a type="button" class="btn btn-success" href="{{url('admin/report/export-supply')}}" role="button">Cetak</a>
        </form>
    </div>
</div>
<div class="table-responsive mt-2">
    <table class=" table table-hover table-bordered">
        <thead>
            <th>No</th>
            <th>Nama Distributor</th>
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
            @foreach ($supplies as $supply)
                @if(!isset($supply['book']))
                    @continue
                @endif
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$supply['distributor']['nama_distributor']  ?? '-'}} </td>
                <td>{{$supply['book']['judul'] ?? '-'}}</td>
                <td>{{$supply['book']['noisbn'] ?? '-'}}</td>
                <td>{{$supply['book']['penulis'] ?? '-'}}</td>
                <td>{{$supply['book']['penerbit'] ?? '-'}}</td>
                <td>{{$supply['book']['harga_jual'] ?? '-'}}</td>
                <td>{{$supply['book']['stok'] ?? '-'}}</td>
                <td>{{$supply['jumlah'] ?? '-'}}</td>
                <td>{{$supply['tanggal'] ?? '-'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>