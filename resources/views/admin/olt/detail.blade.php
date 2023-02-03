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

<script>
    $(document).on('click', '.addPortModal', function() {
        let url = $(this).data('url');
        $('#addPortModalForm').attr('action', url);
    });
    $(document).on('click', '.buttonPengajuanModal', function() {
        let port = $(this).data('port');
        let slot = $(this).data('slot');
        let id_slot = $(this).data('id_slot');
        $('#slot').val(slot);
        $('#port').val(port);
        $('#id_slot').val(id_slot);
    });
    $(document).on('click', '#edit-slot', function() {
        let url_name = $(this).data('url');
        const base_url = "http://127.0.0.1:8000"
        $.ajax({
            url: url_name,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $("#module_update").val(data.module)
                $("#id_slot_model").val(data.id)
                $('#form_edit_module').attr('action', `${base_url}/slot/update/${data.id}`);
                if (data.module === "GPFD" || data.module === "GCOB" || data.module === "GFOA" || data.module === "GPOA" || data.module === "GFCH" || data.module === "GFGH" || data.module === "HFTH" || data.module === "GTGH") {
                    $("#jPortUpdate").val(16);
                } else if (data.module === "GTGO") {
                    $("#jPortUpdate").val(8);
                } else {
                    $("#jPortUpdate").val(null)
                }

            }

        });
    });


    $(document).ready(function() {

        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 3500);

        $('.select-module').on('change', function() {
            if (this.value === "GPFD" || this.value === "GCOB" || this.value === "GFOA" || this.value === "GPOA" || this.value === "GFCH" || this.value === "GFGH" || this.value === "HFTH" || this.value === "GTGH") {
                $("#jPort").val(16);
            } else if (this.value === "GTGO") {
                $("#jPort").val(8);
            } else {
                $("#jPort").val(null)
            }

            if (this.value === "GPFD") {
                $("#announcement").html('Slot number berikut tidak dapat digunakan 0,9,10,18,19,20,21,22')
            } else if (this.value === "GTGO" || this.value === "GTGH") {
                $("#announcement").html('Slot number berikut tidak dapat digunakan 1,10,18-23')
            } else if (this.value === "GFGH" || this.value === "HFTH" || this.value === "GFCH") {
                $("#announcement").html('Slot number berikut tidak dapat digunakan 9,10,11,18-23')
            } else if (this.value === "GCOB") {
                $("#announcement").html('Slot number berikut tidak dapat digunakan 9,10')
            } else if (this.value === "GFOA" || this.value === "GPOA") {
                $("#announcement").html('Slot number berikut tidak dapat digunakan 9,10,19-23')
            } else {
                $("#announcement").html('')

            }
        });

        $('.select-module-update').on('change', function() {
            if (this.value === "GPFD" || this.value === "GCOB" || this.value === "GFOA" || this.value === "GPOA" || this.value === "GFCH" || this.value === "GFGH" || this.value === "HFTH" || this.value === "GTGH") {
                $("#jPortUpdate").val(16);
            } else if (this.value === "GTGO") {
                $("#jPortUpdate").val(8);
            } else {
                $("#jPortUpdate").val(null)
            }
        });

    });
</script>
@endpush
@section('container')



<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col ">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>

            @if(session()->has('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    {{session('success')}}
                </div>
            </div>
            @elseif(session()->has('errorr'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    {{session('errorr')}}
                </div>
            </div>
            @endif




        </div>
    </div>


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>


    <!-- DataTales Example -->
    <div class="row">

        <div class="col-lg-6">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-around align-middle">
                    <h6 class="m-0 font-weight-bold text-primary d-inline-block align-middle">Info Slot (OLT->{{$data->hostname}})
                    </h6>
                    @can('asmen')
                    @if($data->total !== 16)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Slot
                    </button>
                    @endif
                    @endcan
                </div>
                <div class="card-body">
                    @foreach($data->slots as $slot)
                    <div class=" my-2 bg-secondary text-white rounded-2">
                        <div class="header-edit py-1 align-middle text-end px-5 bg-dark">
                            <button type="button" class="btn btn-dark" id="edit-slot" data-bs-toggle="modal" data-bs-target="#modal-edit-slot" data-url="{{ route('slot.edit', $slot->id) }}">Edit</button>
                        </div>
                        <div class="body-slot">
                            <div class="bdy">
                                <a href="{{Route('olt.show', ['olt' => $data->id, 'slot' => $slot->id])}}" class="text-decoration-none select_slot">
                                    <div class=" my-2 bg-secondary text-white rounded-2 d-flex justify-content-around align-self-center" id="slot_column">
                                        <div class="text-center">
                                            <p>Number Slot</p>
                                            <p>{{$slot->number}}</p>
                                        </div>
                                        <div class="text-center">
                                            <p>Jumlah Port</p>
                                            <p>{{$slot->total}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Port Olt</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="">
                        @if($ports)
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
                                <button type="button" class="btn btn-circle @if($port->penggunaan) btn-success @else btn-primary disabled  @endif edit buttonPengajuanModal" data-slot="{{$port->slots->number}}" data-port="{{$port->port_number}}" data-id_slot="{{$port->id_slot}}">
                                    @if($port->penggunaan) v @else x @endif
                                </button>
                                @endcan

                            </div>
                            @endforeach


                        </div>
                        @else
                        <p class="fw-bolder">Slot Belum Dipilih</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>



    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{Route('slot.store')}}" method="post" id="modal_pengajuan">
                        @csrf

                        <div class="col mb-3">
                            <label for="module" class="form-label">Module</label>
                            <select class="form-select select-module @error('module') is-invalid @enderror" id="module" name="module" aria-label="Default select example" required>
                                <option selected>Open this select menu</option>
                                @if($data->type === "MA5600T")
                                <option value="GPFD">GPFD</option>
                                @elseif($data->type === "AN5000")
                                <option value="GCOB">GCOB</option>
                                @elseif($data->type === "AN6000")
                                <option value="GFOA">GFOA</option>
                                <option value="GPOA">GPOA</option>
                                @elseif($data->type === "C630")
                                <option value="GFGH">GFGH</option>
                                <option value="HFTH">HFTH</option>
                                <option value="GFCH">GFCH</option>
                                @elseif($data->type === "C320")
                                <option value="GTGH">GTGH</option>
                                <option value="GTGO">GTGO</option>
                                @endif
                            </select>
                            @error('module')
                            <div id="module" class="invalid-feedback mb-3">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col mb-1">
                            <label for="number" class="form-label">Number Slot</label>
                            <input type="number" required class="form-control" name="number" id="number">
                            <p class="text-muted" id="announcement"></p>
                        </div>
                        <div class="col">
                            <label for="jPort" class="form-label">Jumlah Port</label>
                            <input type="number" required read value="{{old('jPort')}}" class="form-control @error('jPort') is-invalid @enderror" name="jPort" id="jPort" min="1" max="16" readonly="true">
                            @error('jPort')
                            <div id="jPort" class="invalid-feedback mb-3">
                                {{$message}}
                            </div>
                            @enderror
                        </div>




                        <input type="hidden" name="id_olt" id="id_old" value="{{$data->id}}">
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">ADD PORT : OLT {{$data->hostname}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addPortModalForm" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="portAdd" class="form-label">Add Port</label>
                            <input type="number" required class="form-control" name="portAdd" id="portAdd" @if($ports) max="{{16 - $ports->count()}}" @endif min="1" value="1">

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
                        <input type="hidden" name="id_slot" id="id_slot">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="usulan" class="form-label">Usulan</label>
                                    <select class="form-select" id="usulan" name="usulan" aria-label="Default select example" required>
                                        <option selected>Open this select menu</option>
                                        <option value="pembangunan sttf">Pembangunan STTF</option>
                                        <option value="normalisasi">Normalisasi</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="JenisPembangunan" class="form-label">Jenis Pembangunan</label>
                                    <select class="form-select" id="JenisPembangunan" name="jenisPembangunan" aria-label="Default select example" required>
                                        <option selected>Open this select menu</option>
                                        <option value="PT 2">PT 2</option>
                                        <option value="PT 3">PT 3</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="labelODC" class="form-label">Label ODC</label>
                                    <input type="text" required value="{{old('labelODC')}}" class="form-control @error('labelODC') is-invalid @enderror" name="labelODC" id="labelODC" placeholder="exp : ODC-BJD-FCJ ">
                                    @error('labelODC')
                                    <div id="labelODC" class="invalid-feedback mb-3">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="labelODP" class="form-label">Label ODP</label>
                                    <input type="text" required value="{{old('labelODP')}}" class="form-control @error('labelODP') is-invalid @enderror" name="labelODP" id="labelODP" placeholder="exp : ODP-BJD-FCJ/01">
                                    @error('labelODP')
                                    <div id="labelODP" class="invalid-feedback mb-3">
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
                                <div class="mb-3">
                                    <label for="jumlahODP" class="form-label">Jumlah ODP</label>
                                    <input type="number" required value="{{old('jumlahODP')}}" class="form-control @error('jumlahODP') is-invalid @enderror" name="jumlahODP" id="jumlahODP">
                                    @error('jumlahODP')
                                    <div id="jumlahODP" class="invalid-feedback mb-3">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col">

                                        <label for="slot" class="form-label">Slot</label>
                                        <input type="number" required value="{{old('slot')}}" class="form-control @error('slot') is-invalid @enderror" name="slot" id="slot" disabled>
                                        @error('slot')
                                        <div id="slot" class="invalid-feedback mb-3">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="port" class="form-label">Port Number</label>
                                        <input type="number" required value="{{old('port')}}" class="form-control @error('port') is-invalid @enderror" readonly="true" name="port" id="port">
                                        @error('port')
                                        <div id="port" class="invalid-feedback mb-3">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Pengajuan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-edit-slot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_edit_module">
                        @method('put')
                        @csrf
                        <div class="col mb-3">
                            <label for="module" class="form-label">Module</label>
                            <select class="form-select select-module-update @error('module') is-invalid @enderror" id="module_update" name="module" aria-label="Default select example" required>
                                <option selected>Open this select menu</option>
                                @if($data->type === "MA5600T")
                                <option value="GPFD">GPFD</option>
                                @elseif($data->type === "AN5000")
                                <option value="GCOB">GCOB</option>
                                @elseif($data->type === "AN6000")
                                <option value="GFOA">GFOA</option>
                                <option value="GPOA">GPOA</option>
                                @elseif($data->type === "C630")
                                <option value="GFGH">GFGH</option>
                                <option value="HFTH">HFTH</option>
                                <option value="GFCH">GFCH</option>
                                @elseif($data->type === "C320")
                                <option value="GTGH">GTGH</option>
                                <option value="GTGO">GTGO</option>
                                @endif
                            </select>
                            @error('module')
                            <div id="module" class="invalid-feedback mb-3">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="jPortUpdate" class="form-label">Jumlah Port</label>
                            <input type="number" required read value="{{old('jPortUpdate')}}" class="form-control @error('jPortUpdate') is-invalid @enderror" name="jPortUpdate" id="jPortUpdate" min="1" max="16" readonly="true">
                            @error('jPortUpdate')
                            <div id="jPortUpdate" class="invalid-feedback mb-3">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <input type="hidden" name="id_slot" id="id_slot_model">
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



</div>




@endsection