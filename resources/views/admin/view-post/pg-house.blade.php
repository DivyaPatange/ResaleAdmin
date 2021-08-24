@extends('admin.admin_layout.main')
@section('title', 'PG & Guest Houses Post')
@section('page_title', 'PG & Guest Houses Post')
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
                    <h5>{{ $singlePost->pg_name }}</h5>
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
                                <div class="col-md-4">
                                    <p><b>PG Operational Since</b></p>
                                </div>
                                <div class="col-md-8">
                                    <p>: {{ $singlePost->pg_operational_since }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>PG is Presented in</b></p>
                                </div>
                                <div class="col-md-8">
                                    <p>: {{ $singlePost->pg_present_in }}</p>
                                </div>
                                <div class="col-md-12">
                                    <p><b>Description</b></p>
                                    <p>{{ $singlePost->pg_description }}</p>
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
                                    <p><b>Locality</b></p>
                                    <p>{{ $singlePost->locality }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Address</b></p>
                                    <p>{{ $singlePost->address }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Pincode</b></p>
                                    <p>{{ $singlePost->pin_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Landmark</b></p>
                                    <p>{{ $singlePost->landmark }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Ad Posted By</b></p>
                                    <p>{{ $singlePost->ad_posted_by }}</p>
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
