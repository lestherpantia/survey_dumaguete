<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyListController extends Controller
{
    public function index()
    {
        return view('admin.survey_list');
    }

    public function getdata() {
        $surveys = Survey::leftJoin('survey_stub_numbers', 'survey_stub_numbers.id', 'surveys.survey_stub_number_id')
            ->leftJoin('cities', 'cities.id', 'survey_stub_numbers.city_id')
            ->select(
                'surveys.*',
                'survey_stub_numbers.survey_stub',
                'survey_stub_numbers.voucher_code',
                'cities.name as city')
            ->get();
        return response()->json(['surveys' => $surveys], 200);
    }
}

