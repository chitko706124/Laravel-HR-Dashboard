<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $authUser = auth()->user();
        return view('home', compact('authUser'));
    }
}
