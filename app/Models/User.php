<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function favoriteBooks(){
        return $this->belongsToMany(Book::class, 'favorite_books');
    }

    public function receivedBooks(){
        return $this->belongsToMany(Book::class, 'issued_books');
    }
}