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
                <form class="form-horizontal" method="POST" action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Edit Category</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="fname">Category Name</label>
                                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="fname" placeholder="Category Name" name="category_name" value="{{ $category->category_name }}">
                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lname">Status</label>
                                    <select type="text" class="form-control @error('status') is-invalid @enderror" id="lname" name="status">
                                        <option value="">-Select Status-</option>
                                        <option value="1" {{ ($category->status == 1) ? 'selected=selected' : '' }}>Active</option>
                                        <option value="0" {{ ($category->status == 0) ? 'selected=selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="category_icon">Category Icon</label>
                                    <input type="file" class="form-control @error('category_icon') is-invalid @enderror" id="category_icon" name="category_icon">
                                    @error('category_icon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if($category->category_icon)
                            <input type="hidden" class="form-control-file" name="hidden_image" value="{{ $category->category_icon }}">
                            @endif
                            @if($category->category_icon)
                            <div class="col-md-3">
                                <label for=""></label>
                                <div class="form-group">
                                <img src="{{  URL::asset('categoryIcon/' . $category->category_icon) }}" alt="">
                                </div>
                            </div>
                            @endif
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
