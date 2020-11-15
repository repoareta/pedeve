<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Carbon\Carbon;
use Session;
use DB;
use Auth;
use Alert;
use Image;


use Illuminate\Support\Facades\File;

class DefaultController extends Controller
{
    public function index()
    {
        return view('default.index');
    }

    public function upload(Request $request)
    {
        File::delete('profile/'.$request->profil_1);
        $image = $request->file('profil');
        $input = time().'.'.$image->getClientOriginalExtension();
    
        $destinationPath = public_path('profile');
        $img = Image::make($image->getRealPath());
        $img->resize(850, 850, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input);
            $data = $input;
            DB::table('userpdv')->where('userid',Auth::user()->userid)
            ->update([
            'file' => $data
        ]);
        return response()->json();
    }
}
