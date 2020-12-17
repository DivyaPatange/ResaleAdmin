@extends('admin.admin_layout.main')
@section('title', 'Category')
@section('page_title', 'Category')
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
            <div class="card">
                <form class="form-horizontal" method="POST" action="{{ route('admin.category.store') }}">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Add Category</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="fname">Category Name</label>
                                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="fname" placeholder="Category Name" name="category_name" value="{{ old('category_name') }}">
                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Status</label>
                                    <select type="text" class="form-control @error('status') is-invalid @enderror" id="lname" name="status">
                                        <option value="">-Select Status-</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
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
                    <h5 class="card-title">Category List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $c)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $c->category_name }}</td>
                                    <td>@if($c->status == 1) Active @else Inactive @endif</td>
                                    <td>
                                        <a href="{{ route('admin.category.edit', $c->id) }}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"
                                        ><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                        <form action="{{ route('admin.category.destroy', $c->id) }}" method="post">
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
                                    <th>Category Name</th>
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
