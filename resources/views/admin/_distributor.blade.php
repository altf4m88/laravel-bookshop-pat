<div class="card card-primary card-outline mt-3">
    <div class="card-body">
        <div class="card-body mb-3">
            <h3>Form Distributor</h3>
        </div>

        <a href="{{url('/admin/input/create-distributor')}}" class="btn btn-success float-right mb-3">Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nama Distributor</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($distributors as $item)

                <tr>
                    <th>{{$item->nama_distributor}}</th>
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->telepon}}</td>
                    <td>
                        <a href="{{url('admin/input/'.$item->id_distributor.'/update-distributor')}}"><i class="far fa-edit"></i></a> | <a href="{{url('admin/input/'.$item->id_distributor.'/delete-distributor')}}"><i class="fas fa-trash-alt" style="color: red;"></i></a>
                    </td>
                </tr>

            @endforeach
            
            </tbody>
        </table>
    </div>
    
  </div>