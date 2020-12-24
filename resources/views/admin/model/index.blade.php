@extends('admin.admin_layout.main')
@section('title', 'Model')
@section('page_title', 'Model')
@section('customcss')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block mt-3">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('danger'))
            <div class="alert alert-danger alert-block mt-3">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form class="form-horizontal" method="POST" action="{{ route('admin.model-name.store') }}">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Add Model</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="name">Brand Name</label>
                                    <select class="form-control @error('brand_name') is-invalid @enderror" id="name" name="brand_name">
                                        <option value="">-Select Brand-</option>
                                        @foreach($brands as $b)
                                        <option value="{{ $b->id }}">{{ $b->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="fname">Model Name</label>
                                    <input type="text" class="form-control @error('model_name') is-invalid @enderror" id="fname" placeholder="Model Name" name="model_name" value="{{ old('model_name') }}">
                                    @error('model_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lname">Status</label>
                                    <select type="text" class="form-control @error('status') is-invalid @enderror" id="lname" name="status">
                                        <option value="">-Select Status-</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Model List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Brand Name</th>
                                    <th>Model Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($model as $key => $m)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <?php
                                        $brand = DB::table('brands')->where('id', $m->brand_id)->first();
                                    ?>
                                    <td>@if(isset($brand) && !empty($brand)) {{ $brand->brand_name }} @endif</td>
                                    <td>{{ $m->model_name }}</td>
                                    <td>@if($m->status == 1) Active @else Inactive @endif</td>
                                    <td>
                                        <a href="{{ route('admin.model-name.edit', $m->id) }}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"
                                        ><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                        <form action="{{ route('admin.model-name.destroy', $m->id) }}" method="post">
                                        @method('DELETE')
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Brand Name</th>
                                    <th>Model Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@section('customjs')
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script>
    /****************************************
        *       Basic Table                   *
        ****************************************/
    $('#zero_config').DataTable();
</script>
@endsection
@endsection
