<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;

    protected $fillable = ['title','date','description', 'color', 'cumma', 'category_id', 'currency_id'];

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function currencys () {
        return $this->belongsTo(Currencys::class,'currency_id');
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id');
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function add ($fields) {
        $post = new static;
        $post->fill($fields);
        $post->user_id = Auth::user()->id;
        $post->save();
        return $post;
    }

    public  function edit ($fields) {
        $this->fill($fields);
        $this->save();
    }

    public  function remove () {
        $this->delete();
    }

    public  function setCategory ($id) {
        if ($id == null){ return; }

        $this->category_id = $id;
        $this->save();
    }

    public  function setСurrency ($id) {

        if ($id == null){ return; }

        $this->currency_id = $id;
        $this->save();
    }

    public function getCategoryTitle () {
        if ($this->category != null) {
            return $this->category->title;
        }
        return 'Нет категории';
    }

    public function getСurrencyTitles () {
        if ($this->currencys != null) {
            return $this->currencys->title;
        }
        return 'Нет категории';
    }

    public function getPhoneAuthor () {
        if ($this->user != null) {
            return $this->user->phone;
        }
        return 'Нет телефона';
    }

    public function getCategoryID() {
        return $this->category != null ? $this->category->id : null;
    }

    public function related() {
       return self::all()->except($this->id);
    }

}
