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
                <form class="form-horizontal" method="POST" id="typeBrandSubmit">
                    <div class="card-body">
                        <h4 class="card-title">Add Brand</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="type_name">Vehicle Type <span style="color:red;">*</span></label><span  style="color:red" id="type_err"> </span>
                                    <select class="form-control @error('type_name') is-invalid @enderror" id="type_name" name="type_name">
                                        <option value="">-Select Type-</option>
                                        @foreach($type as $t)
                                        <option value="{{ $t->id }}">{{ $t->type_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="brand_name">Brand Name<span style="color:red;">*</span></label><span  style="color:red" id="brand_err"> </span>
                                    <input type="text" class="form-control @error('brand_name') is-invalid @enderror" placeholder="Brand Name" id="brand_name" name="brand_name" >
                                    @error('brand_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="">-Select Status-</option>
                                        <option value="1" @if (old('status') == 1) selected="selected" @endif>Active</option>
                                        <option value="0" @if (old('status') == 0) selected="selected" @endif>Inactive</option>
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
                    <h5 class="card-title">Brand List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Type Name</th>
                                    <th>Brand Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Type Name</th>
                                    <th>Brand Name</th>
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
                    <label for="">Vehicle Type <span style="color:red;">*</span></label><span  style="color:red" id="edit_type_err"> </span>
                    <select name="type_name" id="edit_type_name" class="form-control">
                        <option value="">-Select Vehicle Type-</option>
                        @foreach($type as $t)
                        <option value="{{ $t->id }}">{{ $t->type_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Brand Name <span style="color:red;">*</span></label><span  style="color:red" id="edit_brand_err"> </span>
                    <input type="text" name="brand_name" id="edit_brand_name" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Status <span style="color:red;">*</span></label><span  style="color:red" id="edit_status_err"> </span>
                    <select name="status" id="edit_status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
            <input type="hidden" name="id" id="id" value="">
            <button type="button" class="btn btn-success" id="editModel" onclick="return checkSubmit()">Update</button>
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
<script type=text/javascript>
  var SITEURL = '{{ URL::to('/admin/subCategory/type-brand')}}';
    var sub_category_id = '{{ $subCategory->id }}';
    // var brand = "brand";
    // alert(brand);
    $('#zero_config').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: SITEURL+'/'+sub_category_id,
          type: 'GET',
         },
         columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'type_id', name: 'type_id' },
                  { data: 'type_brand_name', name: 'type_brand_name' },
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
            url:"{{ route('admin.get.type-brand') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                // alert(returndata);
            if (returndata!="0") {
                $("#myModal").modal('show');
                var json = JSON.parse(returndata);
                $("#id").val(json.id);
                $("#edit_brand_name").val(json.brand_name);
                $("#edit_type_name").val(json.type_name);
                $("#edit_status").val(json.status);
                // $("#adv_amt").val(json.advance_amt);
                // $("#total_amt").val(json.total_pay);
            }
            }
        });
    }
    function checkSubmit()
    {
        var brand_name = $("#edit_brand_name").val();
        var type_name = $("#edit_type_name").val();
        var status = $("#edit_status").val();
        var id = $("#id").val().trim();
        // console.log(brand_name=="");
        if (brand_name=="") {
            $("#edit_brand_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_brand_err").fadeOut(); }, 3000);
            $("#edit_brand_name").focus();
            return false;
        }
        if (type_name=="") {
            $("#edit_type_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_type_err").fadeOut(); }, 3000);
            $("#edit_type_name").focus();
            return false;
        }
        if (status=="") {
            $("#edit_status_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_status_err").fadeOut(); }, 3000);
            $("#edit_status").focus();
            return false;
        }
        else
        { 
            $('#editModel').attr('disabled',true);
            var datastring="brand_name="+brand_name+"&status="+status+"&id="+id+"&type_name="+type_name;
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ url('/admin/type-brand/update') }}",
                data:datastring,
                cache:false,        
                success:function(returndata)
                {
                $('#editModel').attr('disabled',false);
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

    $('body').on('click', '#delete-type-brand', function () {
        var id = $(this).data("id");
  
        if(confirm("Are You sure want to delete !")){
            $.ajax({
                type: "delete",
                url: "{{ url('admin/type-brand') }}"+'/'+id,
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
        var type_name = $("#type_name").val();
        var brand_name = $("#brand_name").val();
        var status = $("#status").val();
        var category_id = $("#category_id").val().trim();
        var sub_category_id = $("#sub_category_id").val().trim();
        if (brand_name=="") {
            $("#brand_err").fadeIn().html("Required");
            setTimeout(function(){ $("#brand_err").fadeOut(); }, 3000);
            $("#brand_name").focus();
            return false;
        }
        if (type_name=="") {
            $("#type_err").fadeIn().html("Required");
            setTimeout(function(){ $("#type_err").fadeOut(); }, 3000);
            $("#type_name").focus();
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
            var datastring="brand_name="+brand_name+"&status="+status+"&category_id="+category_id+"&sub_category_id="+sub_category_id+"&type_name="+type_name;
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ route('admin.type-brand.store') }}",
                data:datastring,
                cache:false,        
                success:function(returndata)
                {
                    document.getElementById("typeBrandSubmit").reset();
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

@endsection
@endsection
