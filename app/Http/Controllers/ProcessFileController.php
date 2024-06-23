<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;

class ProcessFileController extends Controller
{

    public function index()
    {
        // Show the page
        return view('processfile/index');
    }

}