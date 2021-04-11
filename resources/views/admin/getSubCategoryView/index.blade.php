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
        <div class="col-md-12">
            @if(($subCategory->sub_category == "Cars") || ($subCategory->sub_category == "Mobile Phones") || ($subCategory->sub_category == "Motorcycles") || ($subCategory->sub_category == "Scooters") || ($subCategory->sub_category == "Apple") || ($subCategory->sub_category == "Bicycles"))
            <a href="{{ route('admin.brand', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Brand</button></a>
            @endif
            @if(($subCategory->sub_category == "Cars") || ($subCategory->sub_category == "Mobile Phones") || ($subCategory->sub_category == "Motorcycles") || ($subCategory->sub_category == "Scooters") || ($subCategory->sub_category == "Apple") || ($subCategory->sub_category == "Bicycles"))
            <a href="{{ route('admin.model', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Model</button></a>
            @endif
            @if($subCategory->sub_category == "Spare Parts - Accessories")
            <a href="{{ route('admin.type', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Product Type</button></a>
            
            @endif
            @if(($subCategory->sub_category == "Part time Jobs") || ($subCategory->sub_category == "Full Time Jobs") || ($subCategory->sub_category == "Internship") || ($subCategory->sub_category == "Freelancer") || ($subCategory->sub_category == "Work Abroad") || ($subCategory->sub_category == "Contract Jobs"))
            <a href="{{ route('admin.role', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Role</button></a>
            
            @endif
             @if(($subCategory->sub_category == "Part time Jobs") || ($subCategory->sub_category == "Full Time Jobs") || ($subCategory->sub_category == "Internship") || ($subCategory->sub_category == "Freelancer") || ($subCategory->sub_category == "Work Abroad") || ($subCategory->sub_category == "Contract Jobs"))
            <a href="{{ route('admin.subrole', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Sub Role</button></a>
            
            @endif
            @if(($subCategory->sub_category == "Cars"))
            <a href="{{ route('admin.car-varient', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Car Varient</button></a>
            @endif
            @if($subCategory->sub_category == "Commercial Vehicles")
            <a href="{{ route('admin.type', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Vehicle Type</button></a>
            @endif
            @if($subCategory->sub_category == "Accessories")
            <a href="{{ route('admin.type', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Accessory Type</button></a>
            @endif
            @if(($subCategory->sub_category == "Tablets") || ($subCategory->sub_category == "Spare Parts") || ($subCategory->sub_category == "Audio / Video / Gaming") || ($subCategory->sub_category == "Home Appliances") || ($subCategory->sub_category == "Computers / Laptops & Accessories") || ($subCategory->sub_category == "Cameras / Lenses / Accessories") || ($subCategory->sub_category == "Kitchen Appliances") || ($subCategory->sub_category == "ACs & Cooler") || ($subCategory->sub_category == "Other Devices") || ($subCategory->sub_category == "Antiques - Handicrafts") || ($subCategory->sub_category == "Furniture for Hospitality") || ($subCategory->sub_category == "Furniture for Industry") || ($subCategory->sub_category == "Furniture for Shop & Showroom") || ($subCategory->sub_category == "Furniture for Office") || ($subCategory->sub_category == "Household Furniture") || ($subCategory->sub_category == "Kitchenware") || ($subCategory->sub_category == "Kids Furniture") || ($subCategory->sub_category == "Paintings") || ($subCategory->sub_category == "Home Decor & Gardening"))
            <a href="{{ route('admin.type', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Type</button></a>
            @endif
            @if(($subCategory->sub_category == "Commercial Vehicles") || ($subCategory->sub_category == "Accessories") || ($subCategory->sub_category == "Tablets") || ($subCategory->sub_category == "Audio / Video / Gaming") || ($subCategory->sub_category == "Home Appliances") || ($subCategory->sub_category == "Computers / Laptops & Accessories") || ($subCategory->sub_category == "Cameras / Lenses / Accessories") || ($subCategory->sub_category == "Kitchen Appliances") || ($subCategory->sub_category == "ACs & Cooler") || ($subCategory->sub_category == "Other Devices") || ($subCategory->sub_category == "Antiques - Handicrafts") || ($subCategory->sub_category == "Furniture for Hospitality") || ($subCategory->sub_category == "Furniture for Industry") || ($subCategory->sub_category == "Furniture for Shop & Showroom") || ($subCategory->sub_category == "Furniture for Office") || ($subCategory->sub_category == "Household Furniture") || ($subCategory->sub_category == "Kitchenware") || ($subCategory->sub_category == "Kids Furniture") || ($subCategory->sub_category == "Paintings") || ($subCategory->sub_category == "Home Decor & Gardening"))
            <a href="{{ route('admin.type-brand', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Brand</button></a>
            @endif
            @if(($subCategory->sub_category == "Property for Rent / Lease") || ($subCategory->sub_category == "Property for Sale"))
            <a href="{{ route('admin.type', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Property Type</button></a>
            @endif

            @if(($subCategory->sub_category == "Men") || ($subCategory->sub_category == "Women") || ($subCategory->sub_category == "Kids"))
            <a href="{{ route('admin.type', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Clothing Type</button></a>
            @endif
            @if(($subCategory->sub_category == "Men") || ($subCategory->sub_category == "Women") || ($subCategory->sub_category == "Kids"))
            <a href="{{ route('admin.size', $subCategory->id) }}"><button type="button" class="btn btn-primary btn-sm">Clothing Size</button></a>
            @endif
        </div>
    </div>
    @if($subCategory->sub_category == "Cars")
        <?php 
            $cars = DB::table('cars')->get(); 
        ?>
        <div class="row mt-4">
            @foreach($cars as $c)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $c->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $c->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewCarPost', $c->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteCarPost', $c->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    @if($subCategory->sub_category == "Commercial Vehicles")
        <?php 
            $commercialVehicle = DB::table('commercial_vehicles')->get(); 
        ?>
        <div class="row mt-4">
            @foreach($commercialVehicle as $com)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $com->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $com->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewComVehiclePost', $com->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteComVehiclePost', $com->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if($subCategory->sub_category == "Spare Parts - Accessories")
        <?php 
            $spareParts = DB::table('spare_parts')->get(); 
        ?>
        <div class="row mt-4">
            @foreach($spareParts as $sparePart)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $sparePart->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $sparePart->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewSparePartPost', $sparePart->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteSparePartPost', $sparePart->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    @if($subCategory->sub_category == "Mobile Phones")
        <?php 
            $mobilePhone = DB::table('mobile_phones')->where('sub_category_id', $subCategory->id)->get(); 
        ?>
        <div class="row mt-4">
            @foreach($mobilePhone as $moPhone)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $moPhone->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $moPhone->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewMobilePhonePost', $moPhone->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteMobilePhonePost', $moPhone->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if($subCategory->sub_category == "Accessories")
        <?php 
            $accessories = DB::table('mobile_accessories')->get(); 
        ?>
        <div class="row mt-4">
            @foreach($accessories as $a)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $a->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $a->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center" style="height:210px">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewMobileAccessoryPost', $a->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteMobileAccessoryPost', $a->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if($subCategory->sub_category == "Tablets")
        <?php 
            $tablets = DB::table('mobile_tablets')->get(); 
        ?>
        <div class="row mt-4">
            @foreach($tablets as $t)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $t->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $t->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center" style="height:210px">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewMobileTabletPost', $t->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteMobileTabletPost', $t->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if($subCategory->sub_category == "Apple")
        <?php 
            $mobilePhone = DB::table('mobile_phones')->where('sub_category_id', $subCategory->id)->get(); 
        ?>
        <div class="row mt-4">
            @foreach($mobilePhone as $moPhone)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $moPhone->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $moPhone->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewMobilePhonePost', $moPhone->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteMobilePhonePost', $moPhone->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if(($subCategory->sub_category == "Part time Jobs") || ($subCategory->sub_category == "Full Time Jobs") || ($subCategory->sub_category == "Internship") || ($subCategory->sub_category == "Freelancer") || ($subCategory->sub_category == "Work Abroad") || ($subCategory->sub_category == "Contract Jobs"))
        <?php 
            $jobs = DB::table('jobs')->where('sub_category_id', $subCategory->id)->get(); 
        ?>
        <div class="row mt-4">
            @foreach($jobs as $job)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $job->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $job->job_title }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewJobPost', $job->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteJobPost', $job->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    <!-- ============================================================== -->
</div>


  
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@section('customjs')
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>

@endsection
@endsection
