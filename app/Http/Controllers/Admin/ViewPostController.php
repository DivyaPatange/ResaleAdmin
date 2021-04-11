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
}
