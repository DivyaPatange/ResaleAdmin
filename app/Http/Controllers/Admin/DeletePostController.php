<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\CommercialVehicle;
use App\Models\Admin\SparePart;
use App\Models\Admin\MobilePhone;
use App\Models\Admin\MobileAccessory;
use App\Models\Admin\MobileTablet;
use App\Models\Admin\Job;

class DeletePostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function deleteCarPost($id)
    {
        $car = DB::table('cars')->where('id', $id);
        $query = $car->first();
        $cid = $query->category_id;
        $sid = $query->sub_category_id;
        $photos = explode(",", $query->photos);
        // for($i=0; $i < count($photos); $i++)
        // {
        //     unlink(public_path('studentPhoto/'.$admission->student_photo));
        // }
        $car->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteComVehiclePost($id)
    {
        $comVehicle = CommercialVehicle::findorfail($id);
        $cid = $comVehicle->category_id;
        $sid = $comVehicle->sub_category_id;
        $comVehicle->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteSparePartPost($id)
    {
        $sparePart = SparePart::findorfail($id);
        $cid = $sparePart->category_id;
        $sid = $sparePart->sub_category_id;
        $sparePart->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteMobilePhonePost($id)
    {
        $mobilePhone = MobilePhone::findorfail($id);
        $cid = $mobilePhone->category_id;
        $sid = $mobilePhone->sub_category_id;
        $mobilePhone->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteMobileAccessoryPost($id)
    {
        $mobileAcce = MobileAccessory::findorfail($id);
        $cid = $mobileAcce->category_id;
        $sid = $mobileAcce->sub_category_id;
        $mobileAcce->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteMobileTabletPost($id)
    {
        $mobileTablet = MobileTablet::findorfail($id);
        $cid = $mobileTablet->category_id;
        $sid = $mobileTablet->sub_category_id;
        $mobileTablet->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteJobPost($id)
    {
        $job = Job::findorfail($id);
        $cid = $job->category_id;
        $sid = $job->sub_category_id;
        $job->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }
}
