@extends('.layout.main')
@push('styles')


@endpush
@push('scripts')

@endpush
@section('container')




<div class="container-fluid">
    <h2 class="h3 mb-2 text-gray-800">Daftar Persetujuan</h2>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Daftar Pengajuan
                    </h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama OLT</th>
                                    <th scope="col">STO</th>
                                    <th scope="col">Label</th>
                                    <th scope="col">Port Pengajuan</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $data)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$data->olt_ports->olts->hostname}}</td>
                                    <td>{{$data->olt_ports->olts->stos->kota}}</td>
                                    <td>{{$data->label}}</td>
                                    <td>{{$data->olt_ports->port_number}}</td>
                                    <td>{{$data->users->name}}</td>
                                    <td>{{(new DateTime($data->create_at))->format(' l, d M Y')}}</td>
                                    <td>
                                        <form action="{{Route('pengajuan.diterima', $data->id)}}" method="post" class="d-inline">

                                            @method('put')
                                            @csrf
                                            <button type="submit" class="border-0 badge  btn-success">
                                                Terima
                                            </button>
                                        </form>
                                        <form action="{{Route('pengajuan.ditolak', $data->id)}}" method="post" class="d-inline">

                                            @method('put')
                                            @csrf
                                            <button type="submit" class="border-0 badge  btn-danger">
                                                Tolak
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection