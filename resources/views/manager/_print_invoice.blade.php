<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card-header mb-3">
                        <h3>Cetak Faktur Penjualan</h3>
                    </div>
                    <form action="{{url('manager/report/invoice')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="faktur-select">No Faktur</label>
                            <select class="form-control" name="invoice_id" id="faktur-select">
                                @foreach ($invoices as $invoice)
                                    <option value="{{$invoice->id_penjualan}}">{{$invoice->id_penjualan}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target="#modal-print-invoice">Cetak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>