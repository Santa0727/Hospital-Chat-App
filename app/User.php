<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Categories;


class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="users";
    protected $primaryKey  = 'id';
    /**
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function type($id)
    {
        return Categories::find($id)->image;
    }

    public function userType()
    {
        if (auth()->user()->user_type == 2) {
            return 'Doctor';
        } else if(auth()->user()->user_type == 3) {
            return 'Patient';
        } else {
            return 'Admin';
        }
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Categories', 'id');
    }

    public function profileImg() {
        $image = auth()->user()->profile_img;
        if ($image) {
            return $image;
        } else {
            return asset('front/img/user_logo.png');
        }
    }

    public function image() {
        if ($this->profile_img) {
            return $this->profile_img;
        } else {
            if ($this->user_type == 2) {
                return asset('front/img/doctor-thumb-02.jpg');
            } else {
                return asset('front/img/user_logo.png');
            }
        }

        return $this->name;
    }

    public function favourite() {
        return $this->hasMany('App\Models\FavouriteDoctor', 'doctor_id')->where('status', 1);
    }
}
