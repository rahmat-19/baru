@extends('.layout.main')
@push('styles')
<link rel="stylesheet" href="/css/trix.css">
<style>
    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none;
    }
</style>

@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="/js/edit.js"></script>
<script src="/js/trix.js"></script>


@endpush
@section('container')



<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>


    <!-- DataTales Example -->
    <div class="row">

        <div class="col-lg-6">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Info Olt</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Name</th>
                                    <th scope="col">Daerah</th>
                                    <th scope="col">Port</th>
                                    <th scope="col">Slot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>{{$data->hostname}}</td>
                                    <td>{{$data->stos->slug}}</td>
                                    <td>{{$data->port}}</td>
                                    <td>{{$data->slot}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>

        <!-- Donut Chart -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Port Olt</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="">
                        <div class="d-flex flex-row bd-highlight mb-3 justify-content-evenly flex-wrap">
                            @foreach($ports as $port)
                            <div class="p-2 bd-highlight shadow-sm rounded text-center px-4 py-2 my-2 mx-2">
                                <div>
                                    <p class="fw-bold">Port</p>
                                    <p>{{$port->port_number}}</p>
                                </div>
                                @can('asmen')
                                <form action="{{Route('port.edit', $port->id)}}" method="post">
                                    @method('put')
                                    @csrf
                                    <button type="submit" class="btn btn-circle @if($port->penggunaan) btn-success @else btn-primary  @endif">
                                        @if($port->penggunaan) v @else x @endif
                                    </button>
                                </form>
                                @else
                                <button type="button" class="btn btn-circle @if($port->penggunaan) btn-success @else btn-primary disabled  @endif edit" data-id="{{$port->id}}">
                                    @if($port->penggunaan) v @else x @endif
                                </button>
                                @endcan

                            </div>
                            @endforeach
                            @can('asmen')
                            <div class="p-2 bd-highlight shadow-sm rounded text-center px-4 py-2 my-2">
                                <div>
                                    <p class="fw-bold">Tambah Port</p>
                                </div>
                                <button type="submit" class="btn btn-circle @if($port->penggunaan) btn-warning @else btn-danger  @endif" data-bs-toggle="modal" data-bs-target="#addPort">
                                    +
                                </button>


                            </div>
                            @endcan
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-editLabel">Buat Pengajuan <span id="idport"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{Route('pengajuan.port')}}" method="post" id="modal_pengajuan">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="usulan" class="form-label">Usuelan</label>
                                <input type="text" required value="{{old('usulan')}}" class="form-control  @error('usulan') is-invalid @enderror" name="usulan" id="usulan" placeholder="Usulan">
                            </div>
                            <div class="mb-3">
                                <label for="JenisPembangunan" class="form-label">Jenis Pembangunan</label>
                                <select class="form-select" id="JenisPembangunan" name="jenisPembangunan" aria-label="Default select example" required>
                                    <option selected>Open this select menu</option>
                                    <option value="ODP">ODP</option>
                                    <option value="ODC">ODC</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="label" class="form-label">Label ODC/ODP</label>
                                <input type="text" required value="{{old('label')}}" class="form-control @error('label') is-invalid @enderror" name="label" id="label" placeholder="exp : GPON00-D2-CAU-3">
                                @error('label')
                                <div id="label" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="distribusi" class="form-label">Distribusi</label>
                                <input type="text" required value="{{old('distribusi')}}" class="form-control @error('distribusi') is-invalid @enderror" name="distribusi" id="distribusi" placeholder="Distribusi">
                                @error('distribusi')
                                <div id="distribusi" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" required value="{{old('alamat')}}" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Jl. Pegangsaan Timur">
                                @error('alamat')
                                <div id="alamat" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="jumlahODP" class="form-label">Jumlah ODP</label>
                                    <input type="number" required value="{{old('jumlahODP')}}" class="form-control @error('jumlahODP') is-invalid @enderror" name="jumlahODP" id="jumlahODP">
                                    @error('jumlahODP')
                                    <div id="jumlahODP" class="invalid-feedback mb-3">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="slot" class="form-label">Slot</label>
                                    <input type="number" required value="{{old('slot')}}" class="form-control @error('slot') is-invalid @enderror" name="slot" id="slot">
                                    @error('slot')
                                    <div id="slot" class="invalid-feedback mb-3">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="keterangan" class="form-label">keterangan</label>
                        <input id="keterangan" type="hidden" name="keterangan" class="@error('keterangan') is-invalid @enderror">
                        <trix-editor input="keterangan"></trix-editor>
                        @error('keterangan')

                        <div class="invalid-feedback">
                            {{$message}}
                        </div>

                        @enderror
                    </div>
                    <input type="hidden" name="id_port" id="id_port">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pengajuan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="addPort" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD PORT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>
                    {{$data->hostname}}
                </h4>
                <form action="{{Route('port.addPort', $data->id)}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="portAdd" class="form-label">Add Port</label>
                        <input type="number" required class="form-control" name="portAdd" id="portAdd">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection