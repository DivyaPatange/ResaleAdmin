@extends('admin.getSubCategoryView.index')
@section('list')
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

    @if(($subCategory->sub_category == "Spare Parts - Accessories") || ($subCategory->sub_category == "Spare Parts"))
        <?php 
            $spareParts = DB::table('spare_parts')->where('sub_category_id', $subCategory->id)->get(); 
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

    @if(($subCategory->sub_category == "Motorcycles") || ($subCategory->sub_category == "Scooters") || ($subCategory->sub_category == "Bicycles"))
        <?php 
            $bikes = DB::table('bikes')->where('sub_category_id', $subCategory->id)->get(); 
        ?>
        <div class="row mt-4">
            @foreach($bikes as $bike)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $bike->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $bike->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center" style="height:200px">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewBikePost', $bike->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteBikePost', $bike->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if(($subCategory->sub_category == "Audio / Video / Gaming") || ($subCategory->sub_category == "Home Appliances") || ($subCategory->sub_category == "Computers / Laptops & Accessories") || 
                ($subCategory->sub_category == "Cameras / Lenses / Accessories") || ($subCategory->sub_category == "Kitchen Appliances") || ($subCategory->sub_category == "ACs & Cooler") || ($subCategory->sub_category == "Other Devices"))
        <?php 
            $electronics = DB::table('t_v_s')->where('sub_category_id', $subCategory->id)->get(); 
        ?>
        <div class="row mt-4">
            @foreach($electronics as $electronic)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $electronic->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $electronic->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center" style="height:200px">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewElectronicPost', $electronic->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteElectronicPost', $electronic->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    @endif

    @if(($subCategory->sub_category == "Antiques - Handicrafts") || ($subCategory->sub_category == "Furniture for Hospitality") || ($subCategory->sub_category == "Furniture for Industry") || ($subCategory->sub_category == "Furniture for Shop & Showroom") || ($subCategory->sub_category == "Furniture for Office") || ($subCategory->sub_category == "Household Furniture") || ($subCategory->sub_category == "Kitchenware") || ($subCategory->sub_category == "Kids Furniture") || ($subCategory->sub_category == "Paintings") || ($subCategory->sub_category == "Home Decor & Gardening"))
        <?php 
            $furnitures = DB::table('furniture')->where('sub_category_id', $subCategory->id)->get(); 
        ?>
        <div class="row mt-4">
            @foreach($furnitures as $furniture)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $furniture->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $furniture->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center" style="height:200px">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewFurniturePost', $furniture->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteFurniturePost', $furniture->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if(($subCategory->sub_category == "Men") || ($subCategory->sub_category == "Women") || ($subCategory->sub_category == "Kids"))
        <?php 
            $fashions = DB::table('fashions')->where('sub_category_id', $subCategory->id)->get(); 
        ?>
        <div class="row mt-4">
            @foreach($fashions as $fashion)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $fashion->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $fashion->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center" style="height:200px">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewFashionPost', $fashion->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteFashionPost', $fashion->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
   
   @if(($subCategory->sub_category == "Entrance Exams Coaching") || ($subCategory->sub_category == "Baby Sitting - Creche") || ($subCategory->sub_category == "Competitive Exams Coaching") || ($subCategory->sub_category == "Distance Learning Education") || ($subCategory->sub_category == "Training & Certifications") || ($subCategory->sub_category == "Career Counseling") || ($subCategory->sub_category == "Hobbies") || ($subCategory->sub_category == "Schools &  Tuitions") || ($subCategory->sub_category == "Study in Abroad Consultants") || ($subCategory->sub_category == "Books & Study Material") || ($subCategory->sub_category == "Vocational Skills Training") || ($subCategory->sub_category == "Workshops"))
        <?php 
            $educations = DB::table('education')->where('sub_category_id', $subCategory->id)->get(); 
        ?>
        <div class="row mt-4">
            @foreach($educations as $education)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $education->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $education->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center" style="height:200px">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewEducationPost', $education->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deleteEducationPost', $education->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
   @endif

   @if(($subCategory->sub_category == "Pet Clinics") || ($subCategory->sub_category == "Fishes & Aquarium") || ($subCategory->sub_category == "Pet Food") || ($subCategory->sub_category == "Pet Accessories") || ($subCategory->sub_category == "Other Pets") || ($subCategory->sub_category == "Pet Training & Grooming"))
        <?php 
            $pets = DB::table('pets')->where('sub_category_id', $subCategory->id)->get(); 
        ?>
        <div class="row mt-4">
            @foreach($pets as $pet)
            <div class="col-md-3">
            <?php 
                $explodePhoto = explode(",", $pet->photos);
            ?>
                <div class="card">
                    <div class="card-header" style="height:78px">
                        <h5 class="card-title mb-2">{{ $pet->ad_title }}</h5>
                    </div>
                    <div class="card-body text-center" style="height:200px">
                        <img src="https://resale99.com/adPhotos/{{ $explodePhoto[0] }}" alt="" style="max-height: 170px; max-width: 100%;">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.viewPetPost', $pet->id) }}"><button type="button" class="btn btn-info btn-sm">View</button>
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        <form action="{{ route('admin.deletePetPost', $pet->id) }}" method="post">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
   @endif
@endsection