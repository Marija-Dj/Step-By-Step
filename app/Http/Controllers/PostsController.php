<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    /*
    //*bara da se logiras pret da mozis da pristapis 
    //*do stranata za spodeluvane na podatoci
    */ 
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        //dd($users);
        //$posts = Post::whereIn('user_id', $users)->get();
      $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
       //dd($users);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }
    public function store()
    {
        $data=request()->validate([
     
             'caption'=>'required',
             'image'=>['required', 'image'],
         ]);


        $imagePath=(request('image')->store('uploads','public'));
        //$image=Image::make(public_path("storege/{$imagePath}"))->fit(1200, 1200);
        $image = Image::make(public_path('storage/'.$imagePath))->fit(1000, 1000);
        $image->save();
        auth()->user()->posts()->create([
            'caption'=>$data['caption'],
            'image'=>$imagePath,
        ]);


       //\App\Post::create($data);

       /*
        $post= new \App\Post();

        $post->caption=$data ['caption'];
        $post->save();*/

       //dd(request()->all());
        //dd('hid');

        return redirect('/profile/' . auth()->user()->id);
    }
    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
        //dd($post);
    }
}
