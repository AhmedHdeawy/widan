<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Service;
use App\Picture;
use Image;

class ServiceController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = Service::where('client_id', $request->id)->with(['client', 'likes', 'dislikes', 'pictures'])
                    ->latest()->paginate(10);
        return $services;
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

       $currentImage->save(public_path('img/services/').$name);

       // $request->merge(['photo' => $name]);
       return $name;
   }


   /**
    * Save Pictures that uploaded by service
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
         'service_id'    => $request->id
       ]);

       $picturesNames[] = $pictures;
     }

     return response()->json($picturesNames);

   }


   /**
    * Delete Picture that uploaded by service
    * @param  Request $request [description]
    * @return [type]           [description]
    */
   public function deletePicture(Request $request)
   {
     $picture = Picture::find($request->picture)->delete();

     $pictures = Picture::where('service_id', $request->id)->get();

     return response()->json($pictures);

   }


    public function create(Request $request)
    {

        // Validate CLient Data
        $this->validateService($request);

        // Create a new service
        $service = Service::create($request->all());

        $service = Service::with(['client', 'likes', 'dislikes', 'pictures'])->where('id', $service->id)->get();

        return response()->json($service);
    }

    /**
     * Update Service
     * @param  Request
     * @return [object]
     */
    public function update(Request $request)
    {
        $this->validateService($request, 'update');

        //  Update Service
        $service = Service::where('id', $request->id)->first();
        $service->update($request->all());

        $service = Service::with(['client', 'likes', 'dislikes', 'pictures'])->where('id', $service->id)->get();

        return response()->json($service);
    }

    /**
     * Delete the service
     */
    public function delete(Request $request, $id)
    {
      $service = Service::where('id', $id)->first();
      $service->delete();

      return response()->json($id);
    }

    /**
     * Valid CLient Object
     * @param  Request $request
     * @return [bool]
     */
    private function validateService(Request $request, $type = null)
    {

      $rules = [
          // 'name' => 'required|min:2|unique:services,name,'.$request->id,
          'name' => ['required','min:2',
          // Rule::unique('services')->where(function($query) use ($request) {
          //     $query->where('client_id', $request->client_id);
          //   })
          ],
          'description' => 'required|min:20|string',
          'details' => 'required|min:5|string',
          'price' => 'required|numeric|between:0,9999999.999',
          'currency' => 'required|min:2|string',
          'status' => 'required',
          'client_id' => 'min:1|numeric',
          'pictures' => 'array'
      ];

      // in case Update client
      // if ($type != null) {
      //   $rules['name'] = [
      //     'required',
      //     'min:2',
      //     Rule::unique('services')->where(function($query) use ($request) {
      //         $query->where('client_id', $request->client_id);
      //       }),
      //       'unique:services,name,'.$request->id,
      //     ];
      // }

      // Run Validate
      $this->validate($request, $rules);

    }


    public function findService(Request $request)
    {
      $q = $request->q;
      $services = Service::where('name', 'LIKE', "%{$q}%")->latest()->paginate(10);
      return $services;
    }


}
