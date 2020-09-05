<?php

namespace App\Entity;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $gaurd = 'customer';

    protected $table = 'customers';

    protected $fillable = [
        'name', 'email', 'socialite_id', 'socialite_name' ,'password', 'password_status', 'role', 'address', 'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function billingAddress(){
        return $this->hasOne(BillingAddress::class);
    }
}
