@extends('admin.admin_layout.main')
@section('title', 'Job Post')
@section('page_title', 'Job Post')
@section('customcss')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
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
                <div class="card-header">
                    <h5>{{ $singlePost->job_title }} (&#8377; {{ $singlePost->price }})</h5>
                </div>
                <?php 
                    $explodePhoto = explode(",", $singlePost->photos);
                ?>
                <div class="card-body">
                    <div class="row section-padding-50 grid-gallery">
                        @for($i=0; $i < count($explodePhoto); $i++)
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-3 @if($i != 0) d-none @endif">
                            <div class="card text-center">
                                <a class="lightbox bg-dark" href="https://resale99.com/adPhotos/{{ $explodePhoto[$i] }}">    
                                    <img src="https://resale99.com/adPhotos/{{ $explodePhoto[$i] }}" style="max-height: 220px;max-width: 100%;">
                                </a>
                            </div>
                        </div>
                        @endfor
                        <div class="col-md-8">
                            <h5>Post Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <p><b>Job Type</b></p>
                                </div>
                                <div class="col-md-3">
                                    <?php 
                                        $subCategory = DB::table('sub_categories')->where('id', $singlePost->sub_category_id)->first();
                                    ?>
                                    <p>: @if(!empty($subCategory)) {{ $subCategory->sub_category }} @endif</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Role</b></p>
                                </div>
                                <div class="col-md-3">
                                    <?php 
                                        $role = DB::table('roles')->where('id', $singlePost->role_id)->first();
                                    ?>
                                    <p>: @if(!empty($role)) {{ $role->role_name }} @endif</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Sub-Role</b></p>
                                </div>
                                <div class="col-md-3">
                                    <?php 
                                        $explodeRole = explode(",", $singlePost->sub_role_id);
                                        for($i=0; $i < count($explodeRole); $i++){
                                            $subRole = DB::table('sub_roles')->where('id', $explodeRole[$i])->first();
                                            if(!empty($subRole)){
                                            $name[] = $subRole->sub_role;
                                            }
                                        }
                                    ?>
                                    <p>: @if(!empty($name)){{ implode(",", $name) }}@endif</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Salary Period</b></p>
                                </div>
                                <div class="col-md-3">
                                    <p>: {{ $singlePost->salary_period }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Position</b></p>
                                </div>
                                <div class="col-md-3">
                                    <p>: {{ $singlePost->position }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Monthly Salary</b></p>
                                </div>
                                <div class="col-md-3">
                                    <p>: Min. {{ $singlePost->min_monthly_salary }} - Max. {{ $singlePost->max_monthly_salary }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Experience</b></p>
                                </div>
                                <div class="col-md-3">
                                    <p>: Min. {{ $singlePost->min_experience }} - Max. {{ $singlePost->max_experience }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Company Name</b></p>
                                </div>
                                <div class="col-md-3">
                                    <p>: {{ $singlePost->company_name }}</p>
                                </div>
                                <div class="col-md-12">
                                    <p><b>Job Description</b></p>
                                    <p>{{ $singlePost->job_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>User Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Name</b></p>
                                    <p> {{ $singlePost->name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Email</b></p>
                                    <p> {{ $singlePost->email }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Mobile No.</b></p>
                                    <p> {{ $singlePost->mobile_no }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>State</b></p>
                                    <?php 
                                        $state = DB::table('states')->where('id', $singlePost->state_id)->first();
                                    ?>
                                    <p>@if(!empty($state)) {{ $state->state_name }} @endif</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>City</b></p>
                                    <?php 
                                        $city = DB::table('cities')->where('id', $singlePost->city_id)->first();
                                    ?>
                                    <p>@if(!empty($city)) {{ $city->city_name }} @endif</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Locality</b></p>
                                    <?php 
                                        $locality = DB::table('localities')->where('id', $singlePost->locality_id)->first();
                                    ?>
                                    <p>@if(!empty($locality)) {{ $locality->locality }} @endif</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Address</b></p>
                                    <p> {{ $singlePost->address }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Pin Code</b></p>
                                    <p> {{ $singlePost->pin_code }}</p>
                                </div>
                            </div>
                        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.grid-gallery', { animation: 'slideIn'});
</script>
@endsection
@endsection
