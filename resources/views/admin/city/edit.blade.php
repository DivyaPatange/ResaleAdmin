@extends('admin.admin_layout.main')
@section('title', 'City')
@section('page_title', 'City')
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
                <form class="form-horizontal" method="POST" action="{{ route('admin.city.update', $city->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Edit City</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="state_name">State</label>
                                    <select class="form-control @error('state_name') is-invalid @enderror" id="state_name" name="state_name">
                                        <option value="">-Select State-</option>
                                        @foreach($states as $s)
                                        <option value="{{ $s->id }}" {{ ($city->state_id == $s->id) ? 'selected=selected' : '' }}>{{ $s->state_name }}</option>
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
                                    <input type="text" class="form-control @error('city_name') is-invalid @enderror" id="city_name" name="city_name" value="{{ $city->city_name }}">
                                    @error('city_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="">-Select Status-</option>
                                        <option value="1" {{ ($city->status == 1) ? 'selected=selected' : '' }}>Active</option>
                                        <option value="0" {{ ($city->status == 0) ? 'selected=selected' : '' }}>Inactive</option>
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
