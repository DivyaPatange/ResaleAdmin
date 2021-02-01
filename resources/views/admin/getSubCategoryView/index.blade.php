@extends('admin.admin_layout.main')
@section('title', $subCategory->sub_category)
@section('page_title', $subCategory->sub_category)
@section('customcss')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form class="form-horizontal" method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Add Category</h4>
                        <div class="row">
                            <div class="col-md-4">
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
                            <div class="col-md-4">
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
        
    </div> -->
    <div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Add Brand</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Add Model Name</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Add Car Varient</a>
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.brands.store') }}">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Add Brand</h4>
                            <div class="row">
                                <input type="hidden" name="category_name" value="{{ $category->id }}">
                                <input type="hidden" name="sub_category" value="{{ $subCategory->id }}">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="fname">Brand Name</label>
                                        <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="fname" placeholder="Brand Name" name="brand_name" value="{{ old('brand_name') }}">
                                        @error('brand_name')
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
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.model-name.store') }}">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Add Model</h4>
                            <div class="row">
                                <input type="hidden" name="category_name" value="{{ $category->id }}">
                                <input type="hidden" name="sub_category" value="{{ $subCategory->id }}">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="fname">Brand Name</label>
                                        <select class="form-control @error('brand_name') is-invalid @enderror" id="fname" name="brand_name">
                                            <option value="">-Select Brand-</option>
                                            @foreach($brands as $ba)
                                            <option value="{{ $ba->id }}">{{ $ba->brand_name }}</option>
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
                                    <div class="form-group ">
                                        <label for="fname">Model Name</label>
                                        <input class="form-control @error('brand_name') is-invalid @enderror" id="fname" name="model_name" placeholder="Model Name" value="{{ old('model_name') }}">
                                        @error('model_name')
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
            <!-- <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Brand List</h5>
                        <div class="table-responsive">
                            <table id="zero_config1" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Brand Name</th>
                                        <th>Model Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
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
            </div> -->
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
    </div>
  </div>
</div>
<div class="row">
@yield('list')
</div>
    <!-- ============================================================== -->
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Brand</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" >
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Brand Name</label>
                    <input type="text" name="brand_name" id="brand_name" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
            <input type="hidden" name="id" id="id" value="">
            <button type="button" class="btn btn-success" id="editBrand" onclick="return checkSubmit()">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
  
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@section('customjs')
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script>
    /****************************************
        *       Basic Table                   *
    ****************************************/
    var SITEURL = '{{ URL::to('/admin/sub-category/')}}';
    var category_id = '{{ $category->id }}';
    var sub_category_id = '{{ $subCategory->id }}';
    // var brand = "brand";
    // alert(brand);
    $('#zero_config').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: "{{ url('admin/getBrands') }}"+'/'+category_id+'/'+sub_category_id,
          type: 'GET',
         },
         columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'brand_name', name: 'brand_name' },
                  { data: 'status', name: 'status' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });

      $('#zero_config1').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: "{{ url('admin/getModels') }}"+'/'+category_id+'/'+sub_category_id,
          type: 'GET',
         },
         columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'brand_name', name: 'brand_name' },
                  { data: 'model_name', name: 'model_name' },
                  { data: 'status', name: 'status' },
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
        url:"{{ route('admin.get.brand') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
          if (returndata!="0") {
            $("#myModal").modal('show');
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#brand_name").val(json.brand_name);
            $("#status").val(json.status);
            // $("#adv_amt").val(json.advance_amt);
            // $("#total_amt").val(json.total_pay);
          }
        }
      });
    }

    function checkSubmit()
    {
        var brand_name = $("#brand_name").val();
        var status = $("#status").val();
        var id = $("#id").val().trim();
        if (brand_name=="") {
            $("#brand_err").fadeIn().html("Required");
            setTimeout(function(){ $("#brand_err").fadeOut(); }, 3000);
            $("#brand_name").focus();
            return false;
        }
        if (status=="") {
            $("#status_err").fadeIn().html("Required");
            setTimeout(function(){ $("#status_err").fadeOut(); }, 3000);
            $("#status").focus();
            return false;
        }
        else
        { 
            $('#editBrand').attr('disabled',true);
            var datastring="brand_name="+brand_name+"&status="+status+"&id="+id;
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ url('/admin/brand/update') }}",
                data:datastring,
                cache:false,        
                success:function(returndata)
                {
                $('#editBrand').attr('disabled',false);
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

    $('body').on('click', '#delete-brand', function () {
  
  var id = $(this).data("id");
  
  if(confirm("Are You sure want to delete !")){
    $.ajax({
        type: "delete",
        url: "{{ url('admin/brands') }}"+'/'+id,
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
</script>
@endsection
@endsection
