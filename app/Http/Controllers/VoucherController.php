<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index() {
        return view('admin.voucher');
    }

    public function getdata() {
        $vouchers = Voucher::leftJoin('surveys', 'surveys.id', 'vouchers.survey_id')
        ->leftJoin('survey_stub_numbers', 'survey_stub_numbers.id', 'surveys.survey_stub_number_id')
        ->select('survey_stub_numbers.survey_stub', 'vouchers.voucher_code', 'vouchers.created_at')
        ->orderBy('vouchers.voucher_code', 'desc')
        ->get();

        return response()->json(['vouchers' => $vouchers]);
    }   
}
