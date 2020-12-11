@extends('layouts.app')

@section('content')
<div class="container">

 <div class="row align">
    <!--Slika na korisniko-->
    <div class="col-3">
     <img class="avatar img-circle img-thumbnail rounded-circle" src="{{$user->profile->profileImage()}}">
    <!--<img class="avatar img-circle img-thumbnail rounded-circle" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">--> <!--src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg"-->
   </div>
    <!-- Ova e korisnickoto ime -->
  <div class="col-9">

    <div class="d-flex justify-content-between align-items-baseline">

       <div class="d-flex align-items-center pb-4 pt-4">
         <div class="h3">{{$user->username}}</div>
         @if(auth()->check() && auth()->user()->id !== $user->id) 
            <follow-button user-id="{{ $user->id }}" follows="{{$follows}}"></follow-button>
            @endif
           
           
            
      </div>
              @can('update', $user->profile)
              <a href="/p/create">Add New Post</a>
              @endcan
        </div>
       
       <!-- Delot kade se dadeni podatocite za:
       koj se sledi
       koj go sledi
       i so ima pbjaveno
       -->
        <div class="d-flex">
              <!--
                //*Pred da kesiram koristev 
                //*{{$user->posts->count()}}
                //*{{ $user->profile->followers->count()}}
                //* $user->following->count()
              -->
             <div><strong class="p-1">{{ $postCount }}</strong>posts</div>
             <div><strong class="p-2">{{ $folloersCount }}</strong>followers</div>
             <div><strong class="p-2">{{ $followingCount }}</strong>following</div>
         </div>


         <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
              <div>{{$user->profile->description}} </div> 
               <div><a herf="#">{{$user->profile->url}}</a></div> 
               @can('update', $user->profile)
               <a href="/profile/{{ $user->id}}/edit">Edit Profile</a>
               @endcan       
         </div>
      </div> 


      <div class="row">
  
  
        @foreach($user->posts as $post)
       <div class="col-4 p-4">
           <a href="/p/{{$post->id}}">
           <img src="/storage/{{$post->image}}" class="w-100">
           </a>
 
        </div>
          @endforeach
      </div>
  </div>

</div>
@endsection
