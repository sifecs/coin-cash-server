<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    const IS_USER = 0;
    const IS_ADMIB = 1;
    const IS_UNBAN = 0;
    const IS_BAN = 1;
    const INCOME = 1;
    const EXPENSES = 2;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Finance () {
        return $this->hasMany(Finance::class);
    }

    public static function add ($fields) {
        $user = new static;
        $user->fill($fields);
        $user-> api_token = Str::random(60);
        $user->save();

        return $user;
    }

    public  function edit ($fields) {
        $this->fill($fields);
        $this->save();
    }

    public function generatePassword ($password) {
        if ($password != null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove() {

        $this->removeAvatar();
        $this->delete();
    }

    public  function uploadAvatar ($image) {
        if ($image == null){ return; }

        $this->removeAvatar();

        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads',$filename);

        $this->avatar = $filename;
        $this->save();
    }

    public function removeAvatar() {
        if ($this->avatar !=null) {
            Storage::delete('uploads/' . $this->avatar);
        }
    }

    public function getImage() {
        if ($this->avatar == null) {
            return '/img/no-user-image.png';
        }
        return '/uploads/'. $this->avatar;
    }

    public function makeAdmin() {
        $this->is_admin = self::IS_ADMIB;
        $this->save();
    }

    public function makeNormal() {
        $this->is_admin = self::IS_USER;
        $this->save();
    }

    public  function toggleAdmin ($valuse) {
        if ($valuse == null){
            return $this->makeNormal();
        }

        return $this->makeAdmin();
    }

    public function ban() {
        $this->status = self::IS_BAN;
        $this->save();
    }

    public function unban() {
        $this->status = self::IS_UNBAN;
        $this->save();
    }

    public  function toggleBan ($valuse) {
        if ($valuse == null){
            return $this->unban();
        }

        return $this->ban();
    }
// TODO: тут будет когда то конвертер валют
    public function getBalans() {
        return $this->balans;
    }

    public function setBalans($balans) {
        $this->balans = $balans;
        $this->save();
        return $this->balans;
    }

    public function update_balans_user($id_category, $balans) {
        if ($id_category == self::INCOME) {
            $this->balans = $this->balans+$balans;
            $this->save();
            return $this->balans;
        }

        if ($id_category == self::EXPENSES) {
            $this->balans = $this->balans-$balans;
            $this->save();
            return $this->balans;
        }

    }

    public function balansPlus($balans) {
        $this->balans = $this->balans+$balans;
        $this->save();
        return $this->balans;
    }
    public function balansMinus($balans) {
        $this->balans = $this->balans-$balans;
        $this->save();
        return $this->balans;
    }

}
