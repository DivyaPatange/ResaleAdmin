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
                        <h4 class="card-title">Add Sub Role</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="role_name">Role <span style="color:red;">*</span></label><span  style="color:red" id="role_err"> </span>
                                    <select class="form-control @error('role_name') is-invalid @enderror" id="role_name" name="role_name">
                                        <option value="">-Select Role-</option>
                                        @foreach($role as $t)
                                        <option value="{{ $t->id }}">{{ $t->role_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sub_role">Sub Role<span style="color:red;">*</span></label><span  style="color:red" id="sub_role_err"> </span>
                                    <input type="text" class="form-control @error('sub_role') is-invalid @enderror" placeholder="Sub Role" id="sub_role" name="sub_role" >
                                    @error('sub_role')
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
                            <button type="button" class="btn btn-primary" id="submitForm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sub Role List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Role Name</th>
                                    <th>Sub Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Role Name</th>
                                    <th>Sub Role</th>
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
          <h4 class="modal-title">Edit Sub Role</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" >
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Role Name <span style="color:red;">*</span></label><span  style="color:red" id="edit_role_err"> </span>
                    <select name="role_name" id="edit_role_name" class="form-control">
                        <option value="">-Select Role-</option>
                        @foreach($role as $t)
                        <option value="{{ $t->id }}">{{ $t->role_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Sub Role <span style="color:red;">*</span></label><span  style="color:red" id="edit_sub_err"> </span>
                    <input type="text" name="sub_role" id="edit_sub_role" value="" class="form-control">
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
  var SITEURL = '{{ URL::to('/admin/subCategory/subrole')}}';
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
                  { data: 'role_id', name: 'role_id' },
                  { data: 'sub_role', name: 'sub_role' },
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
            url:"{{ route('admin.get.subrole') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                // alert(returndata);
            if (returndata!="0") {
                $("#myModal").modal('show');
                var json = JSON.parse(returndata);
                $("#id").val(json.id);
                $("#edit_sub_role").val(json.sub_role);
                $("#edit_role_name").val(json.role_name);
                $("#edit_status").val(json.status);
                // $("#adv_amt").val(json.advance_amt);
                // $("#total_amt").val(json.total_pay);
            }
            }
        });
    }
    function checkSubmit()
    {
        var sub_role = $("#edit_sub_role").val();
        var role_name = $("#edit_role_name").val();
        var status = $("#edit_status").val();
        var id = $("#id").val().trim();
        // console.log(brand_name=="");
        if (sub_role=="") {
            $("#edit_sub_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_sub_err").fadeOut(); }, 3000);
            $("#edit_sub_role").focus();
            return false;
        }
        if (role_name=="") {
            $("#edit_role_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_role_err").fadeOut(); }, 3000);
            $("#edit_role_name").focus();
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
            var datastring="sub_role="+sub_role+"&status="+status+"&id="+id+"&role_name="+role_name;
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ url('/admin/subrole/update') }}",
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
                url: "{{ url('admin/subrole') }}"+'/'+id,
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
        var role_name = $("#role_name").val();
        var sub_role = $("#sub_role").val();
        var status = $("#status").val();
        if (role_name=="") {
            $("#role_err").fadeIn().html("Required");
            setTimeout(function(){ $("#role_err").fadeOut(); }, 3000);
            $("#role_name").focus();
            return false;
        }
        if (sub_role=="") {
            $("#sub_role_err").fadeIn().html("Required");
            setTimeout(function(){ $("#sub_role_err").fadeOut(); }, 3000);
            $("#sub_role").focus();
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
            var datastring="role_name="+role_name+"&status="+status+"&sub_role="+sub_role;
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ route('admin.subrole.store') }}",
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
