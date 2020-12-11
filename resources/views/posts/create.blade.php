@extends('layouts.app')

@section('content')
<div class="container">
  <form action="/p" enctype="multipart/form-data" method="post"> 
    @csrf
   <div class="row">
      <div class="col-8 offset-2">
                <div class="row">
                  <h1>Add New Post</h1> 
                  </div>
             <!--
              //** Ova e naslov na slikata koja ke se postira  
              -->
              <div class="form-group row">
              
                 <label for="caption" class="col-form-label">Post Caption</label>
                 <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption" autofocus>
                 @error('caption')
                         <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                         </span>
                 @enderror    
               </div>
          
             <!--ilona za dodavane na slika -->
             <div class=" form-group row ">
             
                  <label for="image" class=" col-form-label">Post Image</label>
            
                  <input type="file", class="form-control-file" id="image" name="image">
                    @error('image')
                         
                         <strong>{{ $message }}</strong>
                        
                 @enderror 
             </div>

             <!--
               Ova e kopceto 
             -->
              <div class="row pt-3">
                <button class="btn btn-primary">Add New Post</button>
               </div>
        </div>                
     </div>
 </form>
</div>
@endsection
