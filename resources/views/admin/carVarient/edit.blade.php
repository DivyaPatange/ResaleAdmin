@extends('admin.admin_layout.main')
<<<<<<< HEAD
@section('title', 'Car Varient')
@section('page_title', 'Car Varient')
=======
@section('title', 'Suggestion')
@section('page_title', 'Suggestion')
>>>>>>> 8a027b219c7f805469efc4057fe2f3bdafb00b53
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
                <form class="form-horizontal" method="POST" action="{{ route('admin.car-varient.update', $carVarient->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Edit Car Varient</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="category_name">Category</label>
                                    <select class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name">
                                        <option value="">-Select Category-</option>
                                        @foreach($categories as $c)
                                        <option value="{{ $c->id }}" {{ ($carVarient->category_id == $c->id) ? 'selected=selected' : '' }}>{{ $c->category_name }}</option>
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
                                        @foreach($subCategories as $s)
                                        <option value="{{ $s->id }}" {{ ($carVarient->sub_category_id == $s->id) ? 'selected=selected' : '' }}>{{ $s->sub_category }}</option>
                                        @endforeach
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
<<<<<<< HEAD
                                    <label for="brand_name">Brand Name</label>
                                    
                                    <select class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name">
                                        @foreach($brand as $b)
                                        <option value="{{ $b->id }}" {{ ($carVarient->brand_id == $b->id) ? 'selected=selected' : '' }}>{{ $b->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="model_name">Model Name</label>
                                    
                                    <select class="form-control @error('model_name') is-invalid @enderror" id="model_name" name="model_name">
                                        @foreach($model as $m)
                                        <option value="{{ $m->id }}" {{ ($carVarient->model_id == $m->id) ? 'selected=selected' : '' }}>{{ $m->model_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('model_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
=======
>>>>>>> 8a027b219c7f805469efc4057fe2f3bdafb00b53
                                    <label for="car_varient">Car Varient</label>
                                    <input type="text" class="form-control @error('car_varient') is-invalid @enderror" id="car_varient" name="car_varient" value="{{ $carVarient->car_varient }}">
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
<<<<<<< HEAD


  $('#sub_category').change(function(){
  var sub_categoryID = $(this).val();  
//   alert(categoryID);
  if(sub_categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-sub-brand-list')}}?sub_category_id="+sub_categoryID,
      success:function(res){        
      if(res){
        $("#brand_name").empty();
        $("#brand_name").append('<option value="">-Select Brand-</option>');
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

  $('#brand_name').change(function(){
  var brandID = $(this).val();  
//   alert(categoryID);
  if(brandID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-sub-model-list')}}?brand_id="+brandID,
      success:function(res){        
      if(res){
        $("#model_name").empty();
        $("#model_name").append('<option value="">-Select Model-</option>');
        $.each(res,function(key,value){
          $("#model_name").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#model_name").empty();
      }
      }
    });
  }else{
    $("#model_name").empty();
  }   
  });
=======
>>>>>>> 8a027b219c7f805469efc4057fe2f3bdafb00b53
</script>
@endsection
@endsection
