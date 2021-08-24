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

    public function deleteBikePost($id)
    {
        $bike = Bike::findorfail($id);
        $cid = $bike->category_id;
        $sid = $bike->sub_category_id;
        $bike->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteElectronicPost($id)
    {
        $tv = TV::findorfail($id);
        $cid = $tv->category_id;
        $sid = $tv->sub_category_id;
        $tv->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteFurniturePost($id)
    {
        $furniture = Furniture::findorfail($id);
        $cid = $furniture->category_id;
        $sid = $furniture->sub_category_id;
        $furniture->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteFashionPost($id)
    {
        $fashion = Fashion::findorfail($id);
        $cid = $fashion->category_id;
        $sid = $fashion->sub_category_id;
        $fashion->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deleteEducationPost($id)
    {
        $education = Education::findorfail($id);
        $cid = $education->category_id;
        $sid = $education->sub_category_id;
        $education->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }
    public function deletePetPost($id)
    {
        $pet = Pet::findorfail($id);
        $cid = $pet->category_id;
        $sid = $pet->sub_category_id;
        $pet->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deletePropertyRentPost($id)
    {
        $propertyRent = PropertyRent::findorfail($id);
        $propertyRentDetail = PropertyRentDetail::where('rent_id', $id)->first();
        $cid = $propertyRent->category_id;
        $sid = $propertyRent->sub_category_id;
        $propertyRent->delete();
        if(!empty($propertyRentDetail)){
            $propertyRentDetail->delete();
        }
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }
    
    public function deletePropertySalePost($id)
    {
        $propertySale = PropertySale::findorfail($id);
        $cid = $propertySale->category_id;
        $sid = $propertySale->sub_category_id;
        $propertySale->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }

    public function deletePGHousePost($id)
    {
        $pgHouse = PGHouse::findorfail($id);
        $cid = $pgHouse->category_id;
        $sid = $pgHouse->sub_category_id;
        $pgHouse->delete();
        return redirect('/admin/sub-category/'.$cid.'/'.$sid)->with('success', 'Post Deleted Successfully');
    }
}
