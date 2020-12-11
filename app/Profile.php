<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    Protected $guarded=[];

    public function profileImage()
    { 
        $imagePath=($this->image) ? $this->image : '/uploads/zxiUht6vjP1ZnPCQhIE9EMCIjPSdUOnwNZGhwnuy.png';
        return '/storage/' . $imagePath;
    }
    public function followers()
    {
        return $this->belongsToMany(User::class);
        //return belongsToMany(User::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
