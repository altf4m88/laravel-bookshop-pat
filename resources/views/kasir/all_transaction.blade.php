<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card-header mb-3">
                        <h3>Data Penjualan</h3>
                    </div>

                    <div class="my-4">
                        <a href="{{url('cashier/report/print-invoice')}}" type="button" class="btn btn-primary">Cetak</a>
                        <a href="{{url('cashier/report/export-sales')}}" type="button" class="btn btn-success">Export Excel</a>
                    </div>

                    <table id="table">
                        <thead>
                            <tr>
                                <th scope="col">No Faktur</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Jumlah Beli</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">PPN</th>
                                <th scope="col">Diskon</th>
                                <th scope="col">Total harga</th>
                                <th scope="col">Tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $tr)
                            <tr>
                                <td>{{$tr->id_penjualan}}</td>
                                <td>{{$tr->book->judul}}</td>
                                <td>{{$tr->jumlah_beli}}</td>
                                <td>{{$tr->book->harga_pokok}}</td>
                                <td>{{$tr->book->ppn}}%</td>
                                <td>{{$tr->book->diskon}}%</td>
                                <td>{{intval(($tr->total_harga + ($tr->total_harga * $tr->book->ppn / 100)) - ($tr->total_harga * $tr->book->diskon / 100)) }}</td>
                                <td>{{$tr->tanggal}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('#table').dataTable();
    });
    </script>
@endsection