<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Survey;
use App\Models\SurveyStubNumber;
use Illuminate\Support\Facades\DB;
use PDF;

class HomeController extends Controller
{
    public function index() 
    {

            return view('admin.home');

    }

    public function getdata() 
    {

            $city = City::orderBy('id')->get();
            return response()->json(['cities' => $city]);

    } 

    public function filter($city, $transact_type)
    {

            $surveys = Survey::leftJoin('survey_stub_numbers', 'survey_stub_numbers.id', 'surveys.survey_stub_number_id')
            ->where('survey_stub_numbers.city_id', $city)->get();


            /* get form count per location */

            $total_forms_count = SurveyStubNumber::where('city_id', $city)->count();
            $total_froms_filled = $surveys->count();

            $data = [
                'from_count' => $total_forms_count,
                'forms_filled' => $total_froms_filled,
                'forms_remaining' => ($total_forms_count - $total_froms_filled),
            ];


            /* group suvery by gender and language */

            $grouped = [
                'survey_count' => $surveys->where('transact_type', $transact_type)->count(),
                'bisaya' => $surveys->where('language', 'bis')->where('transact_type', $transact_type)->count(),
                'english' => $surveys->where('language', 'eng')->where('transact_type', $transact_type)->count(),
                'male' => $surveys->where('gender', 'Male')->where('transact_type', $transact_type)->count(),
                'female' => $surveys->where('gender', 'Female')->where('transact_type', $transact_type)->count(),
                'public' => $surveys->where('occupation', 'pub_employee')->where('transact_type', $transact_type)->count(),
                'private' => $surveys->where('occupation', 'pri_employee')->where('transact_type', $transact_type)->count(),
                'biz_owner' => $surveys->where('occupation', 'biz_owner')->where('transact_type', $transact_type)->count(),
                'un_emp' => $surveys->where('occupation', 'un_emp')->where('transact_type', $transact_type)->count(),
                'others' => $surveys->where('occupation', 'others')->where('transact_type', $transact_type)->count(),
                'adult' => $surveys->whereBetween('age', [18,40])->where('transact_type', $transact_type)->count(),
                'mid_age' => $surveys->whereBetween('age', [41, 60])->where('transact_type', $transact_type)->count(),
                'senior' => $surveys->whereBetween('age', [60, 100])->where('transact_type', $transact_type)->count(),
                'biz_permit' => $surveys->where('transact_type', 'transact_1')->count(),
                'real_property' => $surveys->where('transact_type', 'transact_2')->count(),
                'issuance_cert' => $surveys->where('transact_type', 'transact_3')->count(),
                'survey_q_1_1_1' => $surveys->where('survey_q_1_1', 'survey_q_1_1_1')->where('transact_type', $transact_type)->count(),
                'survey_q_1_1_2' => $surveys->where('survey_q_1_1', 'survey_q_1_1_2')->where('transact_type', $transact_type)->count(),
                'survey_q_1_2_1' => $surveys->where('survey_q_1_2', 'survey_q_1_2_1')->where('transact_type', $transact_type)->count(),
                'survey_q_1_2_2' => $surveys->where('survey_q_1_2', 'survey_q_1_2_2')->where('transact_type', $transact_type)->count(),
                'survey_q_2_1' => $surveys->where('survey_q_2', 'survey_q_2_1')->where('transact_type', $transact_type)->count(),
                'survey_q_2_2' => $surveys->where('survey_q_2', 'survey_q_2_2')->where('transact_type', $transact_type)->count(),
                'survey_q_2_3' => $surveys->where('survey_q_2', 'survey_q_2_3')->where('transact_type', $transact_type)->count(),
                'survey_q_2_4' => $surveys->where('survey_q_2', 'survey_q_2_4')->where('transact_type', $transact_type)->count(),
                'survey_q_2_5' => $surveys->where('survey_q_2', 'survey_q_2_5')->where('transact_type', $transact_type)->count(),
                'survey_q_3_1' => $surveys->where('survey_q_3', 'survey_q_3_1')->where('transact_type', $transact_type)->count(),
                'survey_q_3_2' => $surveys->where('survey_q_3', 'survey_q_3_2')->where('transact_type', $transact_type)->count(),
                'survey_q_3_3' => $surveys->where('survey_q_3', 'survey_q_3_3')->where('transact_type', $transact_type)->count(),
                'survey_q_3_4' => $surveys->where('survey_q_3', 'survey_q_3_4')->where('transact_type', $transact_type)->count(),
                'survey_q_3_5' => $surveys->where('survey_q_3', 'survey_q_3_5')->where('transact_type', $transact_type)->count(),
                'survey_q_5_1' => $surveys->where('survey_q_5', 'survey_q_5_1')->where('transact_type', $transact_type)->count(),
                'survey_q_5_2' => $surveys->where('survey_q_5', 'survey_q_5_2')->where('transact_type', $transact_type)->count(),
                'survey_q_6_1' => $surveys->where('survey_q_6', 'survey_q_6_1')->where('transact_type', $transact_type)->count(),
                'survey_q_6_2' => $surveys->where('survey_q_6', 'survey_q_6_2')->where('transact_type', $transact_type)->count(),
            ];
            


            return response()->json(['data' => $data, 'grouped' => $grouped]);

    }

    public function improvments() 
    {

            $surveys = Survey::leftJoin('survey_stub_numbers', 'survey_stub_numbers.id', 'surveys.survey_stub_number_id')->select('survey_stub_numbers.survey_stub', 'surveys.survey_q_4')->get();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->getDomPDF()->set_option("enable_php", true);
            $pdf->loadView('pdf.improvement', compact('surveys'));
            return $pdf->stream();

    }

    public function transact_survey() 
    {

            $surveys = Survey::leftJoin('survey_stub_numbers', 'survey_stub_numbers.id', 'surveys.survey_stub_number_id')->select('survey_stub_numbers.survey_stub', 'surveys.survey_q_6_other')->get();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->getDomPDF()->set_option("enable_php", true);
            $pdf->loadView('pdf.transact_fee_survey', compact('surveys'));
            return $pdf->stream();
        
    }
}
