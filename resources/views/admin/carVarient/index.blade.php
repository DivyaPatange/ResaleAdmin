@extends('admin.getSubCategoryView.index')
@section('list')
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    <div class="row mt-5">
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
                <form class="form-horizontal" method="POST" id="carVarientSubmit">
                    <div class="card-body">
                        <h4 class="card-title">Add Car Varient</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="brand_name">Brand Name<span style="color:red;">*</span></label><span  style="color:red" id="brand_err"> </span>
                                    <select class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name">
                                        <option value="">-Select Brand Name-</option>
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
                                <div class="form-group">
                                    <label for="model_name">Model Name<span style="color:red;">*</span></label><span  style="color:red" id="model_err"> </span>
                                    <select class="form-control @error('model_name') is-invalid @enderror" id="model_name" name="model_name">
                                    </select>
                                    @error('model_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="car_varient">Car Varient<span style="color:red;">*</span></label><span  style="color:red" id="car_varient_err"> </span>
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
                            <input type="hidden" id="category_id" value="{{ $category->id }}">
                            <input type="hidden" id="sub_category_id" value="{{ $subCategory->id }}">
                            <button type="button" class="btn btn-primary" id="submitForm">Submit</button>
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
                                    <th>Brand Name</th>
                                    <th>Model Name</th>
                                    <th>Car Varient</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Brand Name</th>
                                    <th>Model Name</th>
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
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Car Varient</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" >
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Brand Name <span style="color:red;">*</span></label><span  style="color:red" id="edit_brand_err"> </span>
                    <select name="brand_name" id="edit_brand_name" class="form-control">
                        <option value="">-Select Brand Name-</option>
                        @foreach($brands as $b)
                        <option value="{{ $b->id }}">{{ $b->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Model Name <span style="color:red;">*</span></label><span  style="color:red" id="edit_model_err"> </span>
                    <select name="model_name" id="edit_model_name" class="form-control">
                        @foreach($models as $m)
                        <option value="{{ $m->id }}">{{ $m->model_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Car Varient <span style="color:red;">*</span></label><span  style="color:red" id="edit_car_varient_err"> </span>
                    <input type="text" name="car_varient" id="edit_car_varient" class="form-control" value="">
                </div>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
            <input type="hidden" name="id" id="id" value="">
            <button type="button" class="btn btn-success" id="editCarVarient" onclick="return checkSubmit()">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
        
      </div>
    </div>
</div>

<!-- ============================================================== -->
@section('customjs')
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>

<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script type=text/javascript>
  var SITEURL = '{{ URL::to('/admin/subCategory/car-varient')}}';
    var sub_category_id = '{{ $subCategory->id }}';
    $('#zero_config').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: SITEURL+'/'+sub_category_id,
          type: 'GET',
         },
         columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'brand_id', name: 'brand_id' },
                  { data: 'model_id', name: 'model_id' },
                  { data: 'car_varient', name: 'car_varient' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });

    function EditModel(obj,bid)
    {
        var datastring="bid="+bid;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.get.car-varient') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                // alert(returndata);
            if (returndata!="0") {
                $("#myModal").modal('show');
                var json = JSON.parse(returndata);
                $("#id").val(json.id);
                $("#edit_brand_name").val(json.brand_id);
                $("#edit_model_name").val(json.model_id);
                $("#edit_car_varient").val(json.car_varient);
                // $("#adv_amt").val(json.advance_amt);
                // $("#total_amt").val(json.total_pay);
            }
            }
        });
    }
    function checkSubmit()
    {
        var brand_name = $("#edit_brand_name").val();
        var model_name = $("#edit_model_name").val();
        var car_varient = $("#edit_car_varient").val();
        var id = $("#id").val().trim();
        // console.log(brand_name=="");
        if (brand_name=="") {
            $("#edit_brand_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_brand_err").fadeOut(); }, 3000);
            $("#edit_brand_name").focus();
            return false;
        }
        if (model_name=="") {
            $("#edit_model_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_model_err").fadeOut(); }, 3000);
            $("#edit_model_name").focus();
            return false;
        }
        if (car_varient=="") {
            $("#edit_car_varient_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_car_varient_err").fadeOut(); }, 3000);
            $("#edit_car_varient").focus();
            return false;
        }
        else
        { 
            $('#editCarVarient').attr('disabled',true);
            var datastring="brand_name="+brand_name+"&car_varient="+car_varient+"&id="+id+"&model_name="+model_name;
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ url('/admin/car-varient/update') }}",
                data:datastring,
                cache:false,        
                success:function(returndata)
                {
                $('#editCarVarient').attr('disabled',false);
                $("#myModal").modal('hide');
                var oTable = $('#zero_config').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(returndata.success);
                
                // location.reload();
                // $("#pay").val("");
                }
            });
        }
    }

    $('body').on('click', '#delete-carVarient', function () {
        var id = $(this).data("id");
  
        if(confirm("Are You sure want to delete !")){
            $.ajax({
                type: "delete",
                url: "{{ url('admin/car-varient') }}"+'/'+id,
                success: function (data) {
                var oTable = $('#zero_config').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(data.success);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    $('body').on('click', '#submitForm', function () {
        var brand_name = $("#brand_name").val();
        var model_name = $("#model_name").val();
        var car_varient = $("#car_varient").val();
        var category_id = $("#category_id").val().trim();
        var sub_category_id = $("#sub_category_id").val().trim();
        if (brand_name=="") {
            $("#brand_err").fadeIn().html("Required");
            setTimeout(function(){ $("#brand_err").fadeOut(); }, 3000);
            $("#brand_name").focus();
            return false;
        }
        if (model_name=="") {
            $("#model_err").fadeIn().html("Required");
            setTimeout(function(){ $("#model_err").fadeOut(); }, 3000);
            $("#model_name").focus();
            return false;
        }
        if (car_varient=="") {
            $("#car_varient_err").fadeIn().html("Required");
            setTimeout(function(){ $("#car_varient_err").fadeOut(); }, 3000);
            $("#car_varient").focus();
            return false;
        }
        else
        { 
            var datastring="brand_name="+brand_name+"&car_varient="+car_varient+"&category_id="+category_id+"&sub_category_id="+sub_category_id+"&model_name="+model_name;
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ route('admin.car-varient.store') }}",
                data:datastring,
                cache:false,        
                success:function(returndata)
                {
                    document.getElementById("carVarientSubmit").reset();
                var oTable = $('#zero_config').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(returndata.success);
                
                // location.reload();
                // $("#pay").val("");
                }
            });
        }
    })
</script>
<script type=text/javascript>
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

  $('#edit_brand_name').change(function(){
  var brandID = $(this).val();  
//   alert(categoryID);
  if(brandID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-sub-model-list')}}?brand_id="+brandID,
      success:function(res){        
      if(res){
        $("#edit_model_name").empty();
        $("#edit_model_name").append('<option value="">-Select Model-</option>');
        $.each(res,function(key,value){
          $("#edit_model_name").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#edit_model_name").empty();
      }
      }
    });
  }else{
    $("#edit_model_name").empty();
  }   
  });
</script>
@endsection
@endsection
