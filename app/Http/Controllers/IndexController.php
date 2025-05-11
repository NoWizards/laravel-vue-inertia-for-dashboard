<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {

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
