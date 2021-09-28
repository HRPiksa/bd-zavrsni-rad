<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = array(
        'name'
    );

    public function users()
    {
        return $this->belongsToMany( User::class, 'user_role' );
    }

    public function permissions()
    {
        return $this->belongsToMany( Permission::class, 'permission_role' );
    }
}
