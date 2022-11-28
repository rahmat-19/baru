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
    <h1 class="h3 mb-2 text-gray-800">Data Asmen</h1>


    <!-- DataTales Example -->
    <div class="row">

        <div class="col-xl-8 col-lg-7">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Asmen</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Pangkat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Pangkat</th>
                                </tr>
                            </tfoot> -->
                            <tbody>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->is_admin}}</td>
                                    <td>
                                        <form action="{{Route('asmen.destroy', $data->username)}}" method="post" class="d-inline">

                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="border-0 badge bg-danger" onclick="return confirm('are you sure ?')"><span data-feather="trash-2"></span>Delete</button>

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

        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add User Asmen</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="">
                        <form action="{{Route('asmen.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="your name">
                                @error('name')
                                <div id="name" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="email" name="email" placeholder="name@example.com">
                                @error('email')
                                <div id="email" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password">
                                @error('password')
                                <div id="password" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <hr>
                            <div class="mb-3">

                                <button type="submit" class="btn btn-info btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    <span class="text">Add User</span>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>



@endsection