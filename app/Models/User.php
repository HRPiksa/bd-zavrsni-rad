<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    use Sortable;

    protected $perPage = 3;

    protected $table = 'users';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'firstname',
        'lastname',
        'email',
        'username',
        'password',
        'remember_token',
        'last_login_at'
    );

    public $sortable = array('firstname',
        'email',
        'username',
        'last_login_at');

    protected $dates = array( 'last_login_at' );

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array(
        'password',
        'remember_token'
    );

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = array(
        'email_verified_at' => 'datetime'
    );

    public function roles()
    {
        return $this->belongsToMany( Role::class, 'user_role' );
    }

    // Provjeri ako korisnik ima niz uloga
    public function has_any_role( $roles )
    {
        if ( $this->roles()->whereIn( 'name', $roles )->first() ) {
            return true;
        }

        return false;
    }

    // Ako korisnik ima određenu ulogu po nazivu uloge
    public function has_role( $role )
    {
        if ( $this->roles()->where( 'name', $role )->first() ) {
            return true;
        }

        return false;
    }

    // Pripada li premisija određenoj roli koju ima trenutno prijavljeni korisnik
    public function has_permission_to( $permission )
    {
        return $this->has_any_role( $permission->roles()->pluck( 'name' ) );
    }

    public function pages()
    {
        return $this->hasMany( Page::class, 'user_id', 'id' );
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken( $value )
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
