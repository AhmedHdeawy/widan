<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;

use App\Models\Blog;


class BlogsController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
      $request->flash();

      $inputsArray = [    
        'blog_translations.blogs_title'   => [ 'like', request('title') ],
        'blogs.blogs_status'              => [ '=', request('status') ]
      ];

      $query = Blog::join('blog_translations', 'blogs.id', 'blog_translations.blog_id')
                        ->groupBy('blogs.id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $blogs = $searchQuery->paginate(env('perPage'));

      return view('dashboard.blogs.index', compact('blogs'));
    }


    /**
     * Goto the form for creating a new blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.blogs.create');
    }


    /**
     * Store a newly created blog.
     *
     * @param  \App\Modules\Admin\Http\Requests\BlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
       // dd($request->all());
        $blog = Blog::create($request->all());

        return redirect()->route('admin.blogs.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Blog $blog)
    {
        $showLang = $request->showLang;
        return view('dashboard.blogs.show', compact('blog', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
      return view('dashboard.blogs.edit', compact('blog'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\BlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->all());

        return redirect()->route('admin.blogs.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the blog
     */
    public function destroy(Blog $blog)
    {
        // Get Image name
        $logo = $blog->blogs_logo;
        
        // Delete Record
        $blog->delete();

        // Delete Image
        $this->deleteFile('blogs/', $logo);


      return back()->with('msg_success', __('lang.deletedSuccessfully'));
    }

}
