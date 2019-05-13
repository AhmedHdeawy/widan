<?php

namespace App\Http\Controllers\Website;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Client;
use App\Review;
use App\Follower;
use App\Category;
use App\City;
use App\User;
use App\Picture;
use Image;

class ClientsController extends Controller
{


    /**
     * Show the client page.
     *
     * @return \Illuminate\Http\Response
     */
    public function client(Request $request, $slug)
    {
        $client = Client::where('slug', $slug)->with(['services', 'pictures', 'user', 'categories', 'followers', 'reviews'])->first();
        
        // Get Followers IDs
        $followersIDs = $client->followers()->pluck('followers.user_id')->toArray();
        $userFollower = false;

        // Check if Auth User is Follower
        if ( auth()->check() && in_array(auth()->user()->id, $followersIDs) ) {
            $userFollower = true;
        }
        
        return view('front.client', compact('client', 'userFollower'));
    }


    /**
     * Show the client page.
     *
     * @return \Illuminate\Http\Response
     */
    public function editClient(Request $request, $id)
    {
        $categories = Category::all();
        $cities = City::all();

        $client = Client::where('id', $id)->first();

        $clientCategoriesID = $client->categories()->pluck('categories.id')->toArray();
        

        return view('front.form', compact('categories', 'client', 'clientCategoriesID', 'cities'));
    }


    /**
     * Show the client page.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateClient(Request $request)
    {
        dd($request->all());
        
        $categories = Category::all();
        $cities = City::all();

        $client = Client::where('id', $id)->first();

        $clientCategoriesID = $client->categories()->pluck('categories.id')->toArray();
        

        return view('front.form', compact('categories', 'client', 'clientCategoriesID', 'cities'));
    }


    /**
     * Follow the client bu User.
     *
     * @return \Illuminate\Http\Response
     */
    public function followClient(Request $request, $clientID)
    {
            
        if (auth()->check()) {
            // If Type == '1', then Follow
            if ($request->type == '1') {
                
                Follower::create([
                    'client_id' =>  $clientID,
                    'user_id'   =>  auth()->user()->id,
                ]);

                // Get Client
                $client = Client::findOrFail($clientID);
                return response()->json(['suc' => 'Success', 'FCount'  => $client->followers->count(), 'type'   =>  '1' ]);

            } 
            else {
                // If Type == '0', then UnFollow

                Follower::where('client_id', $clientID)->where('user_id', auth()->user()->id)->delete();

                // Get Client
                $client = Client::findOrFail($clientID);
                return response()->json(['suc' => 'Success', 'FCount'  => $client->followers->count(), 'type'   =>  '0' ]);
                
            }
            

        } else {

            return response()->json(['err' => 'Not Auth']);
        }

    }



    /**
     * Evaluate Client.
     *
     * @return \Illuminate\Http\Response
     */
    public function evaluation(Request $request, $id)
    {
        Validator::make($request->all(), [
            'evaluation' => 'required|max:5',
            'comment' => 'required|min:5',
        ])->validate();

        $request->merge([
            'client_id' =>  $id,
            'user_id'   =>  auth()->user()->id
        ]);

        Review::create($request->all());

        return redirect()->back();
    }



    


}
