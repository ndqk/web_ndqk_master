<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    protected $table = 'billing_addresses';

    protected $fillable = [
        'customer_id', 'name', 'province_id', 'district_id', 'ward_id', 'address', 'phone',
        'email', 'status'
    ];
}
