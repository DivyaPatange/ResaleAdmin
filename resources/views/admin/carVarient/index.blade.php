@extends('admin.admin_layout.main')
@section('title', 'Car Varient')
@section('page_title', 'Car Varient')
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
                <form class="form-horizontal" method="POST" action="{{ route('admin.car-varient.store') }}">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Add Car Varient</h4>
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
                                <div class="form-group">
                                    <label for="car_varient">Car Varient</label>
                                    <input type="text" class="form-control @error('car_varient') is-invalid @enderror" id="car_varient" name="car_varient" value="{{ old('car_varient') }}">
                                    @error('car_varient')
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
                    <h5 class="card-title">Car Varient List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Category Name</th>
                                    <th>Sub Category</th>
                                    <th>Car Varient</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($carVarient as $key => $s)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <?php
                                        $category = DB::table('categories')->where('id', $s->category_id)->first();
                                        if(!empty($category))
                                        {
                                            $subCategory = DB::table('sub_categories')->where('id', $s->sub_category_id)->first();
                                        }
                                    ?>
                                    <td>@if(isset($category) && !empty($category)) {{ $category->category_name }} @endif</td>
                                    <td>@if(isset($category) && !empty($category)) 
                                        @if(isset($subCategory) && !empty($subCategory)){{ $subCategory->sub_category }}
                                        @endif
                                        @endif
                                    </td>
                                    <td>{{ $s->car_varient }}</td>
                                    <td>
                                        <a href="{{ route('admin.car-varient.edit', $s->id) }}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"
                                        ><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                        <form action="{{ route('admin.car-varient.destroy', $s->id) }}" method="post">
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
                                    <th>Sub Category</th>
                                    <th>Car Varient</th>
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
@endsection
@endsection
