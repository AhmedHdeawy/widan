<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Client;
use App\Category;
use App\User;
use App\Picture;
use Image;

class ClientController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with(['services', 'likes', 'dislikes', 'pictures', 'user', 'categories', 'followers'])
                    ->latest()->paginate(10);
        return $clients;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function userclients(Request $request)
    {
        $clients = Client::where('user_id', $request->id)->with(['services', 'likes', 'dislikes', 'pictures', 'user', 'categories', 'followers'])
                    ->latest()->paginate(10);
        return $clients;
    }

    /**
     * Load Categories
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $categoriesArray = [];
        $categories = Category::all();
        foreach ($categories as $category) {
          $categoriesArray[] = [
            'id' =>  $category->id,
            'name' =>  $category->name,
          ];

        }

        // return response()->json("ss", 404);
        return $categoriesArray;
    }

    /**
     * Load Users
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $usersArray = [];
        $users = User::all();
        foreach ($users as $category) {
          $usersArray[] = [
            'id' =>  $category->id,
            'name' =>  $category->name,
          ];

        }

        // return response()->json("ss", 404);
        return $usersArray;
    }


    /**
    * Store image that uploaded by Dropzone
    */
   public function saveImage($image)
   {
       // make image from data sent
       $currentImage = Image::make($image);

       $mime = $currentImage->mime();                      // // "image\/png"

       $splitMime = explode('/', $mime);                   // [ 'image', 'png ]

       $extension =  $splitMime[count($splitMime) - 1];    // 'png'

       $name = 'taqiim_' . time() . str_random(5) . '.' . $extension;    // 1234344_logo.png

       $currentImage->save(public_path('img/clients/').$name);

       // $request->merge(['photo' => $name]);
       return $name;
   }


   /**
    * Save Pictures that uploaded by client
    * @param  Request $request [description]
    * @return [type]           [description]
    */
   public function savePictures(Request $request)
   {
     $picturesNames = [];

     foreach ($request->pictures as $key => $picture) {
       // Store the picture and get it's Name
       $imageName = $this->saveImage($picture);

       // Insert Picture Data
       $pictures = Picture::create([
         'name'          => $imageName,
         'client_id'    => $request->id
       ]);

       $picturesNames[] = $pictures;
     }

     return response()->json($picturesNames);

   }


   /**
    * Delete Picture that uploaded by client
    * @param  Request $request [description]
    * @return [type]           [description]
    */
   public function deletePicture(Request $request)
   {
     $picture = Picture::find($request->picture)->delete();

     $pictures = Picture::where('client_id', $request->id)->get();

     return response()->json($pictures);

   }


   /**
     * handle team leagues process
     */
    private function configureCategroiesForInsert($categories) {

        /**
         * Get categr from request
         */
        $clientCategories = [];
        foreach ($categories as $category ) {
            // echo $category['id'] . ", " . $category['name'] . '';
            $clientCategories[] = $category['id'];
        }

        return $clientCategories;
    }


    /**
     * Craete Slug for each Client
     * @param  Request $request [description]
     * @return [type]           [description]
     */
     public function makeSlug()
     {
       return mt_rand(1000000, mt_getrandmax());
     }

    public function create(Request $request)
    {
        // Validate CLient Data
        $this->validateClient($request);

        // Get Logo Image name after upload by Vue-dropzone
        $logoName = $this->saveImage($request->logo);

        // Handle workin time if the client Not work full day
        if ($request->working_all == false) {
          $openAt = Carbon::parse($request->open_at)->setTimezone('UTC')->toTimeString();
          $closeAt = Carbon::parse($request->close_at)->setTimezone('UTC')->toTimeString();
          $workingAll = "0";
        } else {
          $openAt = $closeAt = null;
          $workingAll = "1";
        }

        // Make a slug for this client if not provide
        if (!$request->slug) {
          $request->merge([
            'slug'  =>  $this->makeSlug()
          ]);
        }

        //  Add modified requested to request array
        $request->merge([
          'logo' => $logoName,
          'open_at' => $openAt,
          'close_at' => $closeAt,
          'location'  => 'location',
          'working_all'  => $workingAll,
          'user_id' =>  $request->user_id['id']
        ]);

        // Create a new client
        $client = Client::create($request->all());

        // Insert client categories
        $clientCategories = $this->configureCategroiesForInsert($request->categories);
        $client->categories()->attach($clientCategories);

        $client = Client::with(['services', 'likes', 'dislikes', 'pictures', 'user', 'categories', 'followers'])->where('id', $client->id)->get();

        return response()->json($client);
    }

    /**
     * Update Client
     * @param  Request
     * @return [object]
     */
    public function update(Request $request)
    {

        $this->validateClient($request, 'update');

        // if user update Logo manually, then Get Logo Image name after upload by Vue-dropzone
        if (strlen($request->logo) > 100) {
          $logoName = $this->saveImage($request->logo);
        } else {
          $logoName = $request->logo;
        }

        // Handle workin time if the client Not work full day
        if ($request->working_all == false) {
          $openAt = Carbon::parse($request->open_at)->setTimezone('UTC')->toTimeString();
          $closeAt = Carbon::parse($request->close_at)->setTimezone('UTC')->toTimeString();
          $workingAll = "0";

        } else {
          $openAt = $closeAt = null;
          $workingAll = "1";
        }


        /**
        * Add modified requested to request array
        *
        */
        $request->merge([
          'logo' => $logoName,
          'open_at' => $openAt,
          'close_at' => $closeAt,
          'location'  => 'location',
          'working_all'  => $workingAll,
          'user_id' =>  $request->user_id['id']
        ]);

        // check if User has been change The Password
        if($request->password && !empty($request->password)) {
            $request->merge(['password' => $request->password]);
        }

        /**
         * Save Client
         */
        $client = Client::where('id', $request->id)->first();
        $client->update($request->all());

        // Update Categories for the client
        $clientCategories = $this->configureCategroiesForInsert($request->categories);
        $client->categories()->sync($clientCategories);

        $client = Client::with(['services', 'likes', 'dislikes', 'pictures', 'user', 'categories', 'followers'])->where('id', $client->id)->get();

        return response()->json($client);
    }

    /**
     * Delete the client
     */
    public function delete(Request $request, $id)
    {
      $client = Client::where('id', $id)->first();

      // Get logo name
      $imageName = $client->logo;

      // Delete the client
      $client->delete();

      // delete client image
      unlink(public_path('img/clients/').$imageName);

      return response()->json($id);
    }

    /**
     * Valid CLient Object
     * @param  Request $request
     * @return [bool]
     */
    private function validateClient(Request $request, $type = null)
    {

      $rules = [
          'categories' => 'required',
          'name' => 'required|min:2',
          'slug'  =>  'unique:clients',
          'description' => 'required|min:20|string',
          'address' => 'required|min:5|string',
          'phone' => 'required|min:3|string',
          'logo' => 'required|min:10|string',
          'location' => 'min:10|string',
          'open_at' => 'required',
          'close_at' => 'required',
          'status' => 'required',
          'user_id' => 'required',
          // 'pictures' => 'required|array',
      ];

      // in case Update client
      if ($type != null) {
        $rules['slug'] = 'required|min:2|unique:clients,slug,'.$request->id;
        $rules['open_at'] = '';
        $rules['close_at'] = '';
      }

      // Run Validate
      $this->validate($request, $rules);

    }


    public function findClient(Request $request)
    {
      $q = $request->q;
      $clients = Client::where('name', 'LIKE', "%{$q}%")->latest()->paginate(10);
      return $clients;
    }


}
