<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use Sluggable;
    protected $fillable = ['title','color'];

    public function posts() {
       return $this->hasMany(Post::class);
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
