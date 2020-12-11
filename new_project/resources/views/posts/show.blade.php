@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
 <div class="col-6">
      <img src="/storage/{{ $post->image}}" class="w-100">  <!--style="max-width: 500px; max-height: 500px;"-->
 </div>
 <div class="col-4">
       <div class="d-flex align-items-center" >
          <div class="pr-3">
              <img class="rounded-circle w-100" src="{{$post->user->profile->profileImage()}}" style="max-width: 40px;">
          </div>
           <div>
              <div class="font-weight-bold">
          
                   <a href="/profile/{{ $post->user->id }}">
                      <span class="text-dark">
                         {{$post->user->username}}
                      </span>
                  </a>
         
              </div>
          </div>
     </div>
        <hr>
       <p>
          <span class="font-weight-bold">
             <a href="/profile/{{ $post->user->id }}">
                  <span class="text-dark">{{ $post->user->username }}</span>
              </a>
          </span> 
          {{ $post->caption }}
       </p>
    </div>
</div>
</div>
@endsection
