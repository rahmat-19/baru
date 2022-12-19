@extends('.layout.main')
@push('styles')
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

@endpush
@section('container')



<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data STO</h1>


    <!-- DataTales Example -->
    <div class="row">

        <div class="@can('asmen') col-xl-8 col-lg-7 @else col @endcan">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar STO</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Slug</th>
                                    <th>Kota</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{$data->slug}}</td>
                                    <td>{{$data->kota}}</td>


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