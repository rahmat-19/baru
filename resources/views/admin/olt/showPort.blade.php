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
                <div class="card-header py-3 d-flex justify-content-around align-middle">
                    <h6 class="m-0 font-weight-bold text-primary d-inline-block align-middle">Info Slot (OLT->{{$data->hostname}})
                    </h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Slot
                    </button>
                </div>
                <div class="card-body">
                    @foreach($data->slots as $slot)
                    <a href="{{Route('waspang.index')}}">
                        <div>
                            <p class="d-inline-block">{{$loop->iteration}}</p>
                            <p class="d-inline-block">{{$slot->jPort}}</p>
                        </div>
                    </a>
                    @endforeach
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


                        <div class="col">
                            <label for="jPort" class="form-label">Jumlah Port</label>
                            <input type="number" required value="{{old('jPort')}}" class="form-control @error('jPort') is-invalid @enderror" name="jPort" id="jPort">
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



</div>




@endsection