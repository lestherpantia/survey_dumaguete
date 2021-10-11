<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index() {

        $replace = 'gago bobo';
        
        $data = collect(
            [
                'data1' => 'Mark lesther',
                'data3' => 'Janice'
            ],
            [
                'data1' => '1234',
                'data3' => '123'
            ]

        );


        dd($data);


    }
}
