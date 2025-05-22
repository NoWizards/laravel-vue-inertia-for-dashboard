<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        // dd(Auth::check());
        return Inertia('Index/Index', [
            'message' => 'this is a message from IndexController'
        ]);
    }

    public function about()
    {
        return Inertia('Index/About');
    }

    public function contact()
    {
        return "Contact route";
    }
    //
}
