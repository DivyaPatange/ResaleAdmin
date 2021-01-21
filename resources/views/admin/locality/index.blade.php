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
                <form class="form-horizontal" method="POST" action="{{ route('admin.locality.store') }}">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Add Locality</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="state_name">State</label>
                                    <select class="form-control @error('state_name') is-invalid @enderror" id="state_name" name="state_name">
                                        <option value="">-Select State-</option>
                                        @foreach($states as $s)
                                        <option value="{{ $s->id }}">{{ $s->state_name }}</option>
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
                                    <input type="text" class="form-control @error('locality') is-invalid @enderror" id="status" name="locality" value="{{ old('locality') }}">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Locality List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Locality</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($localities as $key => $c)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <?php
                                        $state = DB::table('states')->where('id', $c->state_id)->first();
                                        $city = DB::table('cities')->where('id', $c->city_id)->first();
                                    ?>
                                    <td>@if(isset($state) && !empty($state)) {{ $state->state_name }} @endif</td>
                                    <td>@if(isset($city) && !empty($city)) {{ $city->city_name }} @endif</td>
                                    <td>{{ $c->locality }}</td>
                                    <td>
                                        <a href="{{ route('admin.locality.edit', $c->id) }}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"
                                        ><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                        <form action="{{ route('admin.locality.destroy', $c->id) }}" method="post">
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
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Locality</th>
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
