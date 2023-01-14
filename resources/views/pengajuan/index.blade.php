@extends('layout.main')


@section('container')

<div class="container-fluid">
    <h2 class="h3 mb-2 text-gray-800">Daftar Pengajuan</h2>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Daftar Pengajuan
                    </h6>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama OLT</th>
                                <th scope="col">Label ODP / ODC</th>
                                <th scope="col">Slot</th>
                                <th scope="col">Port</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">izin</th>
                                <th scope="col">waktu</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$data->slots->olts->hostname}}</td>
                                <td>{{$data->labelODP}} / {{$data->labelODC}}</td>
                                <td>{{$data->slots->number}}</td>
                                <td>{{$data->port}}</td>
                                <td>{!! $data->keterangan !!}</td>
                                <td>@if($data->izin === 2) <p class="text-primary">Menunggu</p> @elseif($data->izin === 1) <p class="text-success">Di Izinkan</p> @else <p class="text-danger">Di Tolak</p> @endif</td>
                                <td>{{(new DateTime($data->create_at))->format(' l, d M Y')}}</td>
                                @if($data->izin !== 2)
                                <td><a href="{{Route('pengajuan.pdf', $data->id)}}">print</a></td>
                                @endif

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection