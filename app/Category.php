<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = ['title','color'];
    protected $hidden = ['updated_at', 'created_at'];
    public function posts() {
       return $this->hasMany(Post::class);
    }

    public function removeImage () {
        if($this->icon !=null) {
            Storage::delete('uploads/' . $this->icon);
        }
    }

    public  function uploadImage ($image) {
        if ($image == null){ return; }

        $this->removeImage();

        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads',$filename);

        $this->icon = $filename;
        $this->save();
    }

    public function getImage() {
        if ($this->icon == null) {
            return '/img/no-image.png';
        }
        return '/uploads/'. $this->icon;
    }

    public  function remove () {
        $this->removeImage();
        $this->delete();
    }

}
