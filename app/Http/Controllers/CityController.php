<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    
    public function index() 
    {

            return view('admin.city');

    }

    public function getdata() 
    {

            $cities = City::all();
            return response()->json(['cities' => $cities], 200);

    }

    private function data_to_insert(City $city, $request) 
    {

            $city->name = $request->name;
            return $city->save() 
            ? response()->json(['message' => 'City successfully saved!'], 200)
            : response()->json(['err_msg' => 'Something went wrong!'], 401);

    }

    public function store(Request $request) 
    {

            $request->validate(
                ['name' => 'required|unique:cities'], 
                [
                    'name.required' => 'City field is required',
                    'name.unique' => 'City already exists'
                ]
            );

            $city = new City();
            return $this->data_to_insert($city, $request);

    }

    public function edit($id) 
    {

            $city = City::where('id', $id)->first();
            return response()->json(['city' => $city], 200);
            
    }

    public function update(Request $request) 
    {

            $city = City::where('id', $request->id)->first();
            return $this->data_to_insert($city, $request);

    }

    public function destroy($id) 
    {

            $city = City::where('id', $id)->first();
            return $city->delete()
            ? response()->json(['message' => 'City deleted successfully!'], 200)
            : response()->json(['err_msg' => 'Something went wrong!'], 401);
            
    }

}
