<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RealtorListingController extends Controller
{
    //
    public function index()
    {
        //these are the same
        //$user = Auth::user();         // Global Auth facade
        //$user = $request->user();     // From the request object
        return inertia(
            'Realtor/Index',
            ['listings' => Auth::user()->listings]
        );
    }
}
