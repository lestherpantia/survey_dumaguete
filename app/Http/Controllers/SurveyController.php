<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SurveyStubNumber;
use App\Models\VoucheCode;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function index()
    {
        return view('survey.survey');
    }

    public function store(Request $request) {

        DB::beginTransaction();

        $id = '';

        try
        {

            $find_stub_number = SurveyStubNumber::where('survey_stub', $request->stub_number)->first();
            $survey = new Survey();
            $survey->language = $request->language;
            $survey->name = $request->name;
            $survey->survey_stub_number_id = $find_stub_number->id;
            $survey->occupation = $request->occupation;
            $survey->date = $request->date;
            $survey->age = $request->age;
            $survey->gender = $request->gender;
            $survey->email = $request->email;
            $survey->mobile = $request->mobile;
            $survey->transact_type = $request->transact_type;
            $survey->survey_q_1_1 = $request->survey_q_1_1;
            $survey->survey_q_1_2 = $request->survey_q_1_2;
            $survey->survey_q_2 = $request->survey_q_2;
            $survey->survey_q_3 = $request->survey_q_3;
            $survey->survey_q_4 = $request->survey_q_4;
            $survey->survey_q_5 = $request->survey_q_5;
            $survey->survey_q_6 = $request->survey_q_6;
            $survey->survey_q_6_other = $request->survey_q_6_other;
            $survey->save();
            $id = $survey->id;
        }
        catch(\Illuminate\Database\QueryException $ex) {
            DB::rollback(); /* if the saving encountered an error the changes revert */
            return response()->json(['err_msg' => $ex], 401);
        }

        DB::commit();

        return response()->json(['message' => 'Success'], 200);

        // $code = $request->stub_number;


        // $get_current_voucher = VoucheCode::select('voucher_code_use')->first();

        // $save_voucher = new Voucher();
        // $save_voucher->survey_id = $id;
        // $save_voucher->voucher_code = $get_current_voucher->voucher_code_use;
        // $save_voucher->save();

        // /* update voucher code */

        // $new_tax_id = (int)$get_current_voucher->voucher_code_use + 1;
        // $new_tax_id = str_pad($new_tax_id, 10, "0", STR_PAD_LEFT);


        // $voucher_code = $get_current_voucher->voucher_code_use;


        // DB::table('vouche_codes')->update(['voucher_code_use' => $new_tax_id]);
        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->getDomPDF()->set_option("enable_php", true);
        // $pdf->loadView('voucher.voucher', compact('code', 'voucher_code'));
        // //return $pdf->download('voucher-'. $code .'.pdf');
        // return $pdf->output();



        // // return response()->json(['message' => 'success doy', 'survey_id' => $id], 200);

    }

    public function check($code) {  

            $valid = SurveyStubNumber::leftJoin('shops', 'shops.id', 'survey_stub_numbers.shop_id')->where('survey_stub', $code)->get();
            $exists = Survey::leftJoin('survey_stub_numbers', 'survey_stub_numbers.id', 'surveys.survey_stub_number_id')->where('survey_stub_numbers.survey_stub', $code)->count();
            return response()->json(['used' => $exists, 'valid' => $valid->count(), 'voucher_details' => $valid->first()], 200);

    }

    public function voucher($code, $id) {

        $get_current_voucher = VoucheCode::select('voucher_code_use')->first();

        $save_voucher = new Voucher();
        $save_voucher->survey_id = $id;
        $save_voucher->voucher_code = $get_current_voucher->voucher_code_use;
        $save_voucher->save();

        /* update voucher code */

        $new_tax_id = (int)$get_current_voucher->voucher_code_use + 1;
        $new_tax_id = str_pad($new_tax_id, 10, "0", STR_PAD_LEFT);


        $voucher_code = $get_current_voucher->voucher_code_use;


        DB::table('vouche_codes')->update(['voucher_code_use' => $new_tax_id]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('voucher.voucher', compact('code', 'voucher_code'));
        // return $pdf->download('voucher-'. $code .'.pdf');
        return $pdf->output();
    }

}
