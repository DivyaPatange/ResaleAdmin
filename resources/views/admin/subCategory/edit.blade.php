@extends('admin.admin_layout.main')
@section('title', 'Sub-Category')
@section('page_title', 'Sub-Category')
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
                <form class="form-horizontal" method="POST" action="{{ route('admin.sub-category.update', $subCategory->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Edit Sub-Category</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="fname">Category</label>
                                    <select class="form-control @error('category_name') is-invalid @enderror" id="fname" name="category_name">
                                        <option value="">-Select Category-</option>
                                        @foreach($categories as $c)
                                        <option value="{{ $c->id }}" {{ ($subCategory->category_id == $c->id) ? 'selected=selected' : '' }}>{{ $c->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lname">Sub-Category</label>
                                    <input type="text" class="form-control @error('sub_category') is-invalid @enderror" id="lname" name="sub_category" value="{{ $subCategory->sub_category }}">
                                    @error('sub_category')
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
                                        <option value="1" {{ ($subCategory->status == 1) ? 'selected=selected' : '' }}>Active</option>
                                        <option value="0" {{ ($subCategory->status == 0) ? 'selected=selected' : '' }}>Inactive</option>
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
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
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
