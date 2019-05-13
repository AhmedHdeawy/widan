<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Category;

class CategoriesController extends Controller
{


    /**
     * Show the categories page.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {

        $categories = Category::where('status', '1')->paginate(20);

        return view('front.categories', compact('categories'));
    }

    /**
     * Show the category page.
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request, $slug)
    {
      
        $category = Category::where('slug', $slug)->with('clients')->first();

        return view('front.category', compact('category'));
    }


}
