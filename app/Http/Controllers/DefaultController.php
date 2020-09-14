<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Carbon\Carbon;
use Session;
use DB;

class DefaultController extends Controller
{
    public function index()
    {
        return view('default.index');
    }
}
