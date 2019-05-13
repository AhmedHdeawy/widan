<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Category;
use App\Client;


class HomeController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::where('status', '1')->limit(4)->get();
        
        return view('front.home', compact('categories'));
    }




}
