@extends('admin.admin_layout.main')
@section('title', 'Mobile Tablet Post')
@section('page_title', 'Mobile Tablet Post')
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
                    <h5>{{ $singlePost->ad_title }} (&#8377; {{ $singlePost->price }})</h5>
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
                                    <p><b>Type</b></p>
                                </div>
                                <div class="col-md-3">
                                    <?php 
                                        $type = DB::table('types')->where('id', $singlePost->type_id)->first();
                                    ?>
                                    <p>: @if(!empty($type)) {{ $type->type_name }} @endif</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Brand Name</b></p>
                                </div>
                                <div class="col-md-3">
                                    <?php 
                                        $brand = DB::table('type_brands')->where('id', $singlePost->type_brand_id)->first();
                                    ?>
                                    <p>: @if(!empty($brand)) {{ $brand->type_brand_name }} @endif</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Physical Condition</b></p>
                                </div>
                                <div class="col-md-3">
                                    <p>: {{ $singlePost->physical_condition }}</p>
                                </div>
                                <div class="col-md-12">
                                    <p><b>Description</b></p>
                                    <p>{{ $singlePost->description }}</p>
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
                                <div class="col-md-4">
                                    <p><b>User Type</b></p>
                                    <p> {{ $singlePost->user_type }}</p>
                                </div>
                                @if($singlePost->user_type == "Dealer")
                                <div class="col-md-4">
                                    <p><b>GST No.</b></p>
                                    <p> {{ $singlePost->gst_no }}</p>
                                </div>
                                @endif
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
