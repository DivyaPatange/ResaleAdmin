@extends('admin.admin_layout.main')
@section('title', 'Locality')
@section('page_title', 'Locality')
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
                <form class="form-horizontal" method="POST" action="{{ route('admin.locality.update', $locality->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Edit Locality</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="state_name">State</label>
                                    <select class="form-control @error('state_name') is-invalid @enderror" id="state_name" name="state_name">
                                        <option value="">-Select State-</option>
                                        @foreach($states as $s)
                                        <option value="{{ $s->id }}" {{ ($s->id == $locality->state_id) ? 'selected=selected' : '' }}>{{ $s->state_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city_name">City</label>
                                    <select class="form-control @error('city_name') is-invalid @enderror" id="city_name" name="city_name">
                                        @foreach($cities as $c)
                                        <option value="{{ $c->id }}" {{ ($c->id == $locality->city_id) ? 'selected=selected' : '' }}>{{ $c->city_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Locality</label>
                                    <input type="text" class="form-control @error('locality') is-invalid @enderror" id="status" name="locality" value="{{ $locality->locality }}">
                                    @error('locality')
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

    $('#state_name').change(function(){
  var stateID = $(this).val();  
//   alert(brandID);
  if(stateID){
    $.ajax({
      type:"GET",
      url:"{{url('admin/get-city-list')}}?state_id="+stateID,
      success:function(res){        
      if(res){
        $("#city_name").empty();
        $("#city_name").append('<option>Select City</option>');
        $.each(res,function(key,value){
          $("#city_name").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#city_name").empty();
      }
      }
    });
  }else{
    $("#city_name").empty();
  }   
  });
</script>
@endsection
@endsection
