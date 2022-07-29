<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profileImage(){
        return ($this->image) ? $this->image : '/storage/profile/1024px-No_image_available.svg.png';
    }

    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
