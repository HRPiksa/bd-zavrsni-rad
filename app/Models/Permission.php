<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = array(
        'name',
        'slug',
        'group'
    );

    public function roles()
    {
        return $this->belongsToMany( Role::class, 'permission_role' );
    }
}
