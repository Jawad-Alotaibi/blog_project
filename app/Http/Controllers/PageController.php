<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function homePage()
    {
        //imagine we loaded data from the database
        return view('homepage');
    }

    public function aboutPage()
    {
        return view('single-post');
    }

}
