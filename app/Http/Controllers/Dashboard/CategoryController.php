<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Category;

class CategoryController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('clients')
                    ->latest()->paginate(10);

        // return response()->json("ss", 404);
        return $categories;
    }


    public function create(Request $request)
    {

        // Validate CLient Data
        $this->validateCategory($request);

        $category = Category::create($request->all());

        $category = Category::with('clients')->where('id', $category->id)->get();

        return response()->json($category);
    }

    /**
     * Update Category
     * @param  Request
     * @return [object]
     */

    public function update(Request $request)
    {

        $this->validateCategory($request, 'update');

        $category = Category::where('id', $request->id)->first();
        $category->update($request->all());

        $category = Category::with('clients')->where('id', $category->id)->get();

        return response()->json($category);
    }

    /**
     * Delete the category
     */
    public function delete(Request $request, $id)
    {
      $category = Category::where('id', $id)->first();
      $category->delete();

      return response()->json($id);
    }

    /**
     * Valid CLient Object
     * @param  Request $request
     * @return [bool]
     */
    private function validateCategory(Request $request, $type = null)
    {

      $rules = [
          'name' => 'required|min:2|unique:categories',
          'status' => 'required',
      ];

      // in case Update category
      if ($type != null) {
        $rules['name'] = 'required|min:2|unique:categories,name,'.$request->id;
      }

      // Run Validate
      $this->validate($request, $rules);

    }


    public function findCategory(Request $request)
    {
      $q = $request->q;
      $categories = Category::where('name', 'LIKE', "%{$q}%")->latest()->paginate(10);
      return $categories;
    }


}
