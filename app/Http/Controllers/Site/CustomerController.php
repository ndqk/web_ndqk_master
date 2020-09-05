<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Entity\{Customer, Province, District, Ward, BillingAddress};

use App\Http\Requests\{UpdateCustomerProfileRequest, UpdateCustomerPasswordRequest, CreateBillingAddressRequest};

class CustomerController extends Controller
{
    public function profile(){
        $tabs = \Request::query('tab', []);

        $customer = Auth::guard('customer')->user();

        $billingAddress = BillingAddress::where('customer_id', $customer->id)->first();

        $provinces = $this->locationSortByName(Province::all());

        $province_id = $billingAddress ? $billingAddress->province_id : $provinces->first()->id;
        $districts = $this->locationSortByName(District::where('province_id', $province_id)->get());

        $district_id = $billingAddress ? $billingAddress->district_id : $districts->first()->id;
        $wards = $this->locationSortByName(Ward::where('district_id', $district_id)->get());


        return view('site.customer.profile', 
            compact('customer', 'tabs', 'provinces', 'districts', 'wards', 'billingAddress'));
    }

    public function profileUpdate(UpdateCustomerProfileRequest $request){
        $existCustomer = Customer::where('email', $request->email)->first();
        if($existCustomer->id != Auth::guard('customer')->user()->id)
            return redirect()->back()->withErrors(['Email đã được sử dụng cho tài khoản khác']);
        $existCustomer = Customer::where('phone', $request->phone)->first();
        if($existCustomer->id != Auth::guard('customer')->user()->id)
            return redirect()->back()->withErrors(['Số điện thoại đã được sử dụng cho tài khoản khác']);
        
        $newProfile = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];

        Auth::guard('customer')->user()->update($newProfile);

        return redirect()->route('customer.profile')->with('status', 'Cập nhật thông tin thành công');
    }

    public function profileChangePassword(UpdateCustomerPasswordRequest $request){
        $customer = Auth::guard('customer')->user();
        if($customer->password_status){
            if(!$request->currpass)
                return redirect()->back()->withErrors(['Mật khẩu không được để trống']);
            if(!Hash::check($request->currpass, $customer->password))
                return redirect()->back()->withErrors(['Mật khẩu không chính xác']);
            if($request->newpass === $request->currpass)
                return redirect()->back()->withErrors(['Mật khẩu mới không được trùng với mật khẩu cũ']);
        }
        $customer->update([
            'password' => Hash::make($request->newpass),
            'password_status' => 1
        ]);
        return redirect()->route('customer.profile')->with('status', 'Cập nhật mật khẩu thành công');
    }

    public function createBillingAddress(CreateBillingAddressRequest $request){
        $billingAddress = new BillingAddress([
            'customer_id' => Auth::guard('customer')->user()->id,
            'name' => $request->name,
            'province_id' => $request->province,
            'district_id' => $request->district,
            'ward_id' => $request->ward,
            'address' => $request->street_address,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 0
        ]);
        $billingAddress->save();
        return redirect()->back()->with('status', 'Cập nhật thành công');
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
