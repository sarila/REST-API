<?php
namespace App;

use App\Transformers\UserTransformer;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens, Authenticatable;

    const VERIFIED_USER ='1';
    const UNVERIFIED_USER ='0';

    const ADMIN_USER ='true';
    const REGULAR_USER ='false';

    public $transformer = UserTransformer::class;
    protected $table = 'users';
    protected $dates = ['deletes_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
         'verification_token',
    ];
    //Accessor and Mutator for Name Field
    //for Mutator 
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
    }

    //for Accessor
    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    //Mutator for email
    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isVerified(){
        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin(){
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode(){
        return str_random(40);
    }
}
