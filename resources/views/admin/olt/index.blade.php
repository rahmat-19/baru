@extends('.layout.main')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/datatables/dataTables.bootstrap4.min.css">


@endpush
@push('scripts')
<script src="/datatables/jquery.dataTables.min.js"></script>
<script src="/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush
@section('container')



<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Olt</h1>


    <!-- DataTales Example -->
    <div class="row">

        <div class="@can('asmen') col-xl-8 col-lg-7 @else col @endcan">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Olt</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Hostname</th>
                                    <th>STO</th>
                                    <th>Slot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{$data->hostname}}</td>
                                    <td>{{$data->stos->slug}}</td>
                                    <td>@if($data->total) {{$data->total}} @else <p>Belum Ada Slot</p> @endif</td>
                                    <td class="text-center">
                                        @can('asmen')
                                        <form action="{{Route('olt.destroy', $data->id)}}" method="post" class="d-inline">

                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="border-0 badge bg-danger" onclick="return confirm('are you sure ?')">Delete</button>

                                        </form>
                                        @endcan

                                        <a href="{{Route('olt.show', $data->id)}}" class="border-0 badge bg-warning"></span>Detail</a>

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>

        @can('asmen')
        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <div class="row row justify-content-between">

                        <div class="col align-self-center">
                            <h6 class="m-0 font-weight-bold text-primary">Add Olt</h6>
                        </div>
                        <div class="col align-self-center text-end">
                            <button type="submit" class="btn btn-success btn-icon-split" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Import</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="">
                        <form action="{{Route('olt.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="hostname" class="form-label">Hostname</label>
                                <input type="text" value="{{old('hostname')}}" class="form-control @error('hostname') is-invalid @enderror" name="hostname" id="hostname" placeholder="Name Olt">
                                @error('hostname')
                                <div id="hostname" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="sto" class="form-label">STO</label>

                                <select class="js-example-basic-single form-select" id="id_sto" name="id_sto" style="width: 100%;">
                                    <option>Select</option>
                                    @foreach($stos as $sto)
                                    <option value={{$sto->id}}>{{$sto->kota}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <div class="mb-3">

                                <button type="submit" class="btn btn-info btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    <span class="text">Add OLT</span>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endcan

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{Route('sto.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Import File Excel</label>
                            <input class="form-control" type="file" name="file" id="formFile">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



</div>



@endsection