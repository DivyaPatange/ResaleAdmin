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
                                    <label for="category_name">Category</label>
                                    <select class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name">
                                        <option value="">-Select Category-</option>
                                        @foreach($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->category_name }}</option>
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
                                    <label for="sub_category">Sub-Category</label>
                                    <select class="form-control @error('sub_category') is-invalid @enderror" id="sub_category" name="sub_category">
                                    </select>
                                    @error('sub_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="name">Brand Name</label>
                                    <select class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name">
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
                                    <th>Category</th>
                                    <th>Sub Category</th>
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
                                        $category = DB::table('categories')->where('id', $m->category_id)->first();
                                        $subCategory = DB::table('sub_categories')->where('id', $m->sub_category_id)->first();
                                    ?>
                                    <td>@if(isset($category) && !empty($category)) {{ $category->category_name }} @endif</td>
                                    <td>@if(isset($subCategory) && !empty($subCategory)) {{ $subCategory->sub_category }} @endif</td>
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
                                    <th>Category</th>
                                    <th>Sub Category</th>
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
<script type=text/javascript>
  $('#category_name').change(function(){
  var categoryID = $(this).val();  
//   alert(categoryID);
  if(categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-subcategory-list')}}?category_id="+categoryID,
      success:function(res){        
      if(res){
        $("#sub_category").empty();
        $("#sub_category").append('<option>Select Sub-Category</option>');
        $.each(res,function(key,value){
          $("#sub_category").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#sub_category").empty();
      }
      }
    });
  }else{
    $("#sub_category").empty();
  }   
  });
</script>

<script type=text/javascript>
  $('#sub_category').change(function(){
  var subCategoryID = $(this).val();  
//   alert(categoryID);
  if(subCategoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-brand-list')}}?brand_id="+subCategoryID,
      success:function(res){        
      if(res){
        $("#brand_name").empty();
        $("#brand_name").append('<option>-Select Brand-</option>');
        $.each(res,function(key,value){
          $("#brand_name").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#brand_name").empty();
      }
      }
    });
  }else{
    $("#brand_name").empty();
  }   
  });
</script>
@endsection
@endsection
