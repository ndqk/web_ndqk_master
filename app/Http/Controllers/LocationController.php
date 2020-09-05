<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Entity\{Customer, Province, District, Ward};


class LocationController extends Controller
{
    public function districts($province){
        $districts = District::where('province_id', $province)->get();
        $districts = $districts->sortBy(function($district){
            return Str::slug((substr(strstr($district->name, " "), 1)));
        })->values()->all();
        $res = '';
        foreach($districts as $district){
            $res .= '<option value="'.$district->id.'">'.$district->name.'</option>';
        }
        return $res;
    }

    public function wards($district){
        $wards = Ward::where('district_id', $district)->get();
        $wards = $wards->sortBy(function($ward){
            return Str::slug((substr(strstr($ward->name, " "), 1)));
        })->values()->all();
        $res = '';
        foreach($wards as $ward){
            $res .= '<option value="'.$ward->id.'">'.$ward->name.'</option>';
        }
        return $res;
    }
}
