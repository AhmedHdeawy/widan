<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Image;

class UserController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['likes', 'dislikes', 'comments', 'clients', 'followers'])
                    ->latest()->paginate(10);
        return $users;
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

       $name = 'taqiim_' . time() . str_random(5) . '.' . $extension;    // 1234344_avatar.png

       $currentImage->save(public_path('img/users/').$name);

       // $request->merge(['photo' => $name]);
       return $name;
   }

    public function create(Request $request)
    {

        // Validate CLient Data
        $this->validateUser($request);

        // Get Logo Image name after upload by Vue-dropzone
        $avatarName = $this->saveImage($request->avatar);

        //  Add modified requested to request array
        $request->merge([
          'avatar' => $avatarName,
          'location'  => 'location',
          'username'  =>  mt_rand(1000000, mt_getrandmax())
        ]);

        // Create New User
        $user = User::create($request->all());

        $user = User::with(['likes', 'dislikes', 'comments', 'clients', 'followers'])->where('id', $user->id)->get();

        return response()->json($user);
    }

    /**
     * Update User
     * @param  Request
     * @return [object]
     */

    public function update(Request $request)
    {

        $this->validateUser($request, 'update');

        // if user update Logo manually, then Get Logo Image name after upload by Vue-dropzone
        if (strlen($request->avatar) > 100) {
          $avatarName = $this->saveImage($request->avatar);
        } else {
          $avatarName = $request->avatar;
        }

        //  Add modified requested to request array
        $request->merge([
          'avatar' => $avatarName,
          'location'  => 'location',
        ]);


        // check if User has been change The Password
        if($request->password && !empty($request->password)) {
            $request->merge(['password' => $request->password]);
        }

        //  Save User
        $user = User::where('id', $request->id)->first();
        $user->update($request->all());

        $user = User::with(['likes', 'dislikes', 'comments', 'clients', 'followers'])->where('id', $user->id)->get();

        return response()->json($user);
    }

    /**
     * Delete the user
     */
    public function delete(Request $request, $id)
    {
      $user = User::where('id', $id)->first();
      $user->delete();

      return response()->json($id);
    }

    /**
     * Valid CLient Object
     * @param  Request $request
     * @return [bool]
     */
    private function validateUser(Request $request, $type = null)
    {

      $rules = [
          'name' => 'required|min:2|unique:users',
          'email' => 'required|email|unique:users',
          'password' => 'required|string',
          'avatar' => 'required|min:10|string',
          // 'location' => 'required|min:10|string',
          'location' => '',
          'status' => 'required',
      ];

      // in case Update user
      if ($type != null) {
        $rules['name'] = 'required|min:2|unique:users,name,'.$request->id;
        $rules['password'] = 'string|min:2';
        $rules['email'] = 'required|min:2|unique:users,email,'.$request->id;
      }

      // Run Validate
      $this->validate($request, $rules);

    }


    public function findUser(Request $request)
    {
      $q = $request->q;
      $users = User::where('name', 'LIKE', "%{$q}%")->latest()->paginate(10);
      return $users;
    }


}
