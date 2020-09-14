<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Entity\{Customer, Province, District, Ward, BillingAddress};

class CheckOutController extends Controller
{
    public function index(){
        $customer = Auth::guard('customer')->user();

        $billingAddress = BillingAddress::where('customer_id', $customer->id)->first();

        $provinces = $this->locationSortByName(Province::all());

        $province_id = $billingAddress ? $billingAddress->province_id : $provinces->first()->id;
        $districts = $this->locationSortByName(District::where('province_id', $province_id)->get());

        $district_id = $billingAddress ? $billingAddress->district_id : $districts->first()->id;
        $wards = $this->locationSortByName(Ward::where('district_id', $district_id)->get());

        $cartItems = $customer->cart()->first()->cartItems()->with('product')->get();
        // return $cartItems;

        return view('site.order.checkout', 
            compact('customer', 'provinces', 'districts', 'wards', 'billingAddress', 'cartItems'));
    }

    private function locationSortByName($collection){
        return $collection->sortBy(function($province){
                    if(strstr($province->name, "Thành phố")){
                        $tmp = Str::slug($province->name);
                        return (substr(strstr($tmp, "thanh-pho"), 10));
                    }
                    return Str::slug(substr(strstr($province->name, " "), 1));
                });
    }
}
