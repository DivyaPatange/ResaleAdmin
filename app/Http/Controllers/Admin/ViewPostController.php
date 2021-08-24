<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Car;
use App\Models\Admin\CommercialVehicle;
use App\Models\Admin\SparePart;
use App\Models\Admin\MobilePhone;
use App\Models\Admin\MobileAccessory;
use App\Models\Admin\MobileTablet;
use App\Models\Admin\Job;
use App\Models\Admin\Bike;
use App\Models\Admin\TV;
use App\Models\Admin\Furniture;
use App\Models\Admin\Education;
use App\Models\Admin\Pet;
use App\Models\Admin\Fashion;
use App\Models\Admin\PropertyRent;
use App\Models\Admin\PropertyRentDetail;
use App\Models\Admin\PropertySale;
use App\Models\Admin\PGHouse;

class ViewPostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function viewCarPost($id)
    {
        $singlePost = Car::findorfail($id);
        return view('admin.view-post.car', compact('singlePost'));
    }

    public function viewComVehiclePost($id)
    {
        $singlePost = CommercialVehicle::findorfail($id);
        return view('admin.view-post.commercial-vehicle', compact('singlePost'));
    }

    public function viewSparePartPost($id)
    {
        $singlePost = SparePart::findorfail($id);
        return view('admin.view-post.spare-part', compact('singlePost'));
    }

    public function viewMobilePhonePost($id)
    {
        $singlePost = MobilePhone::findorfail($id);
        return view('admin.view-post.mobile-phone', compact('singlePost'));
    }

    public function viewMobileAccessoryPost($id)
    {
        $singlePost = MobileAccessory::findorfail($id);
        return view('admin.view-post.mobile-accessory', compact('singlePost'));
    }

    public function viewMobileTabletPost($id)
    {
        $singlePost = MobileTablet::findorfail($id);
        return view('admin.view-post.mobile-tablet', compact('singlePost'));
    }

    public function viewJobPost($id)
    {
        $singlePost = Job::findorfail($id);
        return view('admin.view-post.job', compact('singlePost'));
    }

    public function viewBikePost($id)
    {
        $singlePost = Bike::findorfail($id);
        return view('admin.view-post.bike', compact('singlePost'));
    }

    public function viewElectronicPost($id)
    {
        $singlePost = TV::findorfail($id);
        return view('admin.view-post.electronic', compact('singlePost'));
    }

    public function viewFurniturePost($id)
    {
        $singlePost = Furniture::findorfail($id);
        return view('admin.view-post.furniture', compact('singlePost'));
    }

    public function viewFashionPost($id)
    {
        $singlePost = Fashion::findorfail($id);
        return view('admin.view-post.fashion', compact('singlePost'));
    }

    public function viewEducationPost($id)
    {
        $singlePost = Education::findorfail($id);
        return view('admin.view-post.education', compact('singlePost'));
    }

    public function viewPetPost($id)
    {
        $singlePost = Pet::findorfail($id);
        return view('admin.view-post.pet', compact('singlePost'));
    }

    public function viewPropertyRentPost($id)
    {
        $singlePost = PropertyRent::findorfail($id);
        $propertyRentDetail = PropertyRentDetail::where('rent_id', $id)->first();
        return view('admin.view-post.property-rent', compact('singlePost', 'propertyRentDetail'));
    }

    public function viewPropertySalePost($id)
    {
        $singlePost = PropertySale::findorfail($id);
        return view('admin.view-post.property-sale', compact('singlePost'));
    }

    public function viewPGHousePost($id)
    {
        $singlePost = PGHouse::findorfail($id);
        return view('admin.view-post.pg-house', compact('singlePost'));
    }
}
