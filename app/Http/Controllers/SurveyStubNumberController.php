<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Shop;
use App\Models\SurveyStubNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class SurveyStubNumberController extends Controller
{


    public function index() 
    {

            return view('admin.survey_stab');

    }

    public function getdata() 
    {
            return response()->json(['cities' => City::orderBy('id')->get()], 200);

    }

    public function getshopdata($city_id) 
    {

            return response()->json(['shops' => Shop::where('city_id', $city_id)->get()], 200);
         
    } 

    public function store(Request $request) 
    {

            $request->validate(
            [
                'city' => 'required', 
                'store' => 'required'
            ], 
            [
                'city.required' => 'City is required',
                'store.required' => 'Store is required',
            ]);


            $pcs = $request->number_of_stub;
            $current_stub_numbers = collect();
            $new_stub_numbers = collect();
            $count_pushed = 0;
            $char = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $data = [];


            $stub_number = SurveyStubNumber::select('survey_stub','voucher_code')->get();



            DB::beginTransaction();


            try 
            {
                for($i = 0; $i < $pcs; $i++) 
                {       

                    $survey_number = '';
                    $voucher_code = '';

                    /* check if the survey number is exist */

                    do {
                        $survey_number = str_shuffle($char);
                        $survey_number = substr($survey_number, 0, 5);
                    }
                    while($stub_number->where('survey_stub', $survey_number)->count() > 0);

                    /* create voucher code */


                    do {
                        $voucher_code = str_shuffle($char);
                        $voucher_code = substr($voucher_code, 0, 10);
                    }
                    while($stub_number->where('voucher_code', $voucher_code)->count() > 0);


                    /* save all data */

                    
                    $save_data = new SurveyStubNumber();
                    $save_data->survey_stub = $survey_number;
                    $save_data->voucher_code = $voucher_code;
                    $save_data->city_id = $request->city;
                    $save_data->shop_id = $request->store;
                    $save_data->save();

                    $count_pushed++;
                    
                }

            } 
            catch(\Illuminate\Database\QueryException $ex) 
            {
                DB::rollback();
                return response()->json(['err_message' => $ex], 401);
            }

            DB::commit();
            return response()->json(['message' => 'Survey number successfully generated! ' . $count_pushed]);

    }

    public function destroy($id) 
    {

            $data = SurveyStubNumber::where('id', $id)->first();
            return $data->delete() ? response()->json(['message' => 'Successfully deleted!'], 200) : response()->json(['err_msg' => 'Something went wrong!'], 401);
    
    }



    public function filter($city, $shop) 
    {
        
            return response()->json(
            [
                'stub_numbers' => SurveyStubNumber::leftJoin('cities', 'cities.id', 'survey_stub_numbers.city_id')
                ->select('survey_stub_numbers.*' , 'cities.name as city')
                ->where('city_id', $city)->where('shop_id', $shop)->get()
            ], 200); 
    
    }



    public function pdf($city, $shop) 
    {

            $stub_number = SurveyStubNumber::leftJoin('cities', 'cities.id', 'survey_stub_numbers.city_id')
            ->leftJoin('shops', 'shops.id', 'survey_stub_numbers.shop_id')
            ->select('survey_stub_numbers.*', 'cities.name as city', 'shops.shop_name')
            ->where('survey_stub_numbers.city_id', $city)
            ->where('survey_stub_numbers.shop_id', $shop)
            ->get();

            $pdf = \App::make('dompdf.wrapper');
            $pdf->getDomPDF()->set_option("enable_php", true);
            $pdf->loadView('pdf.stub_number', compact('stub_number'));
            return $pdf->stream();

    }


}
