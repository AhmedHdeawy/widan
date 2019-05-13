<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Category;


class CategoriesController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());

      $name = $request->name;
      $status = $request->status;

      $request->flash();

      $categories = null;
      if ($request->name || $request->status) {  
        $categories = Category::where('name', 'LIKE', "%{$name}%")->where('status', $status)->with('clients')->latest()->paginate(10);
      } else {
        $categories = Category::with('clients')->latest()->paginate(15);
      }


      return view('dashboard.categories.index', compact('categories'));
    }


    /**
     * Goto the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.categories.create');
    }


    /**
     * Store a newly created category.
     *
     * @param  \App\Modules\Admin\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->merge([
            'slug'  =>  $this->makeSlug($request->name)
        ]);

        $category = Category::create($request->all());

        return redirect()->route('dashboard.categories')->with('msg_success', 'Category Add Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = Category::where('id', $category->id)->with('clients')->first();
        return view('dashboard.categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      return view('dashboard.categories.edit', compact('category'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request)
    {

        $request->merge([
            'slug'  =>  $this->makeSlug($request->name)
        ]);

        dd($request->all());
        

        $category = Category::where('id', $request->id)->first();
        $category->update($request->all());

        return redirect()->route('dashboard.categories')->with('msg_success', 'Category Updated Successfully');
    }

    /**
     * Delete the category
     */
    public function destroy(Category $category)
    {

      $category->delete();

      return back()->with('msg_success', 'Category Deleted Successfully');
    }



    /**
     * Craete Slug for each Client
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function makeSlug($string = null, $separator = "-") {

        if (is_null($string)) {
            return "";
        }

        // Remove spaces from the beginning and from the end of the string
        $string = trim($string);

        // Lower case everything 
        // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
        $string = mb_strtolower($string, "UTF-8");;

        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and arabic charactrs as well
        $string = preg_replace("/[^a-z0-9_\s-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);

        // Remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }


}
