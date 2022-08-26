<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = "addresses";
    protected $fillable = [
        'address',
        'city',
        'state',
        'landmark',
        'pincode',
        'address_type'
    ];

    public function addressExist($userId)
    {
        return Address::where('id', $userId)->first();
    }
    public function userAddress($userId)
    {
        $userAddress = Address::select('addresses.id', 'addresses.user_id', 'addresses.address', 'addresses.city', 'addresses.state', 'addresses.landmark', 'addresses.pincode', 'addresses.address_type')
            ->where([['addresses.user_id', '=', $userId]])
            ->get();
        return $userAddress;
    }

    public function address($request, $currentUser)
    {
        $address = new Address();
        $address->user_id = $currentUser->id;
        $address->address = $request->input('address');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->landmark = $request->input('landmark');
        $address->pincode = $request->input('pincode');
        $address->address_type = $request->input('address_type');

        return $address;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}