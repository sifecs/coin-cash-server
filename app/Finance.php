<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Finance extends Model
{

    protected $fillable = ['date','comment', 'amount', 'category_id', 'currency_id'];
    protected $hidden = ['updated_at', 'created_at', 'currency_id', 'category_id'];

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function currencys () {
        return $this->belongsTo(Currencys::class,'currency_id');
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id');
    }

    public static function add ($fields) {
        $financ = new static;
        $financ->fill($fields);
        $financ->user_id = Auth::user()->id;
        $financ->setСurrency(1);
        $financ->save();
        return $financ;
    }

    public  function edit ($fields) {
        $this->fill($fields);
        $this->setСurrency(1);
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

    protected $table = 'finance';
}
