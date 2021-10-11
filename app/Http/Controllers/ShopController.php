<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\City;

class ShopController extends Controller
{
    public function index() {
        return view('admin.shop');
    }

    public function getdata() {
        return response()->json(['shops' => Shop::leftJoin('cities', 'cities.id', 'shops.city_id')->select('shops.*', 'cities.name as city')->orderBy('id')->get(), 'cities' => City::orderBy('id')->get()], 200);
    }

    private function save_request(Shop $shop, Request $request, $message) {
        $shop->shop_name = $request->shop_name;
        $shop->shop_address = $request->shop_address;
        $shop->city_id = $request->city_id;
        return $shop->save() ? response()->json(['message' => $message ], 200) : response()->json(['err_message' => 'Something went Wrong'],401); 
    }

    public function store(Request $request) {
        $request->validate(
        [
            'shop_name' => 'required',
            'shop_address' => 'required'
        ] , 
        [ 
            'shop_name.required' => 'Name is Required',
            'shop_address.required' => 'Address is Required'
        ]);
            

        $shop = new Shop();
        return $this->save_request($shop, $request, 'Successfully Saved');
    }

    public function edit($id) {
        return response()->json(['shop' => Shop::where('id', $id)->first()], 200);
    }

    public function update(Request $request) {

        $request->validate(
        [
            'shop_name' => 'required',
            'shop_address' => 'required'
        ] , 
        [ 
            'shop_name.required' => 'Name is Required',
            'shop_address.required' => 'Address is Required'
        ]);

        $shop = Shop::where('id', $request->id)->first();
        return $this->save_request($shop, $request, 'Successfully Updated'); 
    }

    public function destroy($id) {
        $shop = Shop::where('id', $id)->first();
        return $shop->delete() ? response()->json(['message' => 'Successfully Deleted'], 200) : response()->json(['err_message' => 'Something went wrong'], 401); 
    }

}
