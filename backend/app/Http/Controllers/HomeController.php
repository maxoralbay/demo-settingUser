<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /***
     * Home page
     */
    public function index(Request $request)
    {
        // userId  from auth
        $userId = $request->user()->id ?? 1;
        return view('home.form', ['userId' => $userId]);
    }


}
