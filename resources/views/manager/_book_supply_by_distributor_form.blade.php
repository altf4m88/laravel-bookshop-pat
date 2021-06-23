<div class="card text-center">
    <div class="card-header">
        Filter By Distributor
    </div>
    <div class="card-body">
        <h5 class="card-title">Form Filter Pasok Berdasarkan Distributor</h5>
        <div class="form-group form-inline text-right">
            <div class="clearfix"></div>
                <div class="controls">
                    <form method="post" action="{{url('manager/report/supply-by-distributor')}}" class=" myform form-group form-inline">
                        @csrf
                        <label class=" text-bold">Nama Distributor :</label>
                        <select class="form-select"  name="distributor" required>
                            @foreach ($distributors as $distributor)
                                <option value="{{ $distributor['id_distributor'] }}">{{ $distributor['nama_distributor'] }}</option>
                            @endforeach
                        </select>
                        <br>
                        <button type="submit" class="btn btn-lg btn-primary">Lihat</button>
                    </form>
                </div>
        </div>
    </div>
</div>