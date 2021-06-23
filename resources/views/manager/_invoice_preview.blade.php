<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Jumlah Beli</th>
            <th>Harga Satuan</th>
            <th>PPN</th>
            <th>Diskon</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>1</td>
            <td>{{$book->judul}}</td>
            <td>{{$receipt->jumlah_beli}}</td>
            <td>{{$book->harga_pokok}}</td>
            <td>10%</td>
            <td>{{$book->diskon}}</td>

            <td align="right">{{$receipt->total_harga}}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-right">Jumlah</td>
            <td colspan="3"><strong>{{$receipt->jumlah_beli}} buku</strong></td>
            <td class="text-right">Grand Total</td>
            <td class="text-right"><strong>{{$receipt->total_harga_transaksi}}</strong></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right">Bayar</td>
            <td class="text-right"><strong>{{$receipt->bayar}}</strong></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right">Kembalian</td>
            <td class="text-right"><strong>{{$receipt->kembalian}}</strong></td>
        </tr>
    </table>
</div>
<a target="_blank" href="{{url('manager/report/invoice', $receipt->id_penjualan)}}" class="btn btn-lg btn-block btn-success">Cetak Struk</a>
<a href="{{url('manager/report/invoice')}}" class="btn btn-lg btn-block btn-secondary">Kembali</a>