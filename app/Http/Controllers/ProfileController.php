<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
//use Image;
use Intervention\Image\Facades\Image;


  class ProfileController extends Controller
{
     public function index (User $user)
    {   
      
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        
        //dd($follows);

        //$postCount=$user->posts->count();
        //$folloersCount=$user->posts->count();
        //$followingCount=$user->posts->count();
         
        //* Kesirane 
        $postCount=Cache::remember(
          'count.posts'. $user->id, 
          now()->addSeconds(30), 
          function() use ($user)
          {
          return $user->posts->count();
          }
        );

        $folloersCount=Cache::remember(
          'count.folloers'. $user->id,
          now()->addSeconds(30),
          function () use ($user) 
          {
           return $user->profile->followers->count();
          }
        );

        $followingCount=Cache::remember(
          'count.folloing'. $user->id,
          now()->addSeconds(30),
          function() use ($user)
          {
                return $user->following->count();
          }
        );

        //** findOrfail e metod za 404 */
        //$user = User::findOrfail($user);
        //** tuka mora da e home deka za da net deka e povrzan so fajlot home.blade*/
        return view('profiles.index', compact('user', 'follows', 'postCount', 'folloersCount','followingCount'));
        
    }
    public function edit (User $user)
    { 
        $this->authorize('update', $user->profile);

       return view('profiles.edit', compact('user'));
    }
    public function update(User $user)
    {
     $this->authorize('update', $user->profile);

       $date = request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'',

        ]);
 
      if(request('image')){
        $imagePath=(request('image')->store('profile','public'));
        
        $image = Image::make(public_path('storage/'.$imagePath))->fit(1000, 1000);
        $image->save();
      }
      
      
      //dd($date);
      /*dd(array_merge(
        $date,
        ['image'=>$imagePath],
      ));*/

     auth()->user()->profile->update(array_merge(
            $date,
            ['image'=>$imagePath],
        ));
        

        //return redirect("/proflie/". auth()->user()->id);
        return redirect("/proflie/".auth()->user()->id);
    }

 }
