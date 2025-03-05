<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $data = ['Mg Mg', 'Ko Ko', 'Zaw Zaw'];
        return view('about', ['students' => $data]);
    }
}
