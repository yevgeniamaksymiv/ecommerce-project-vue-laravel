<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = false;

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    protected $fillable = ['name'];

    public const IS_ADMIN = 1;
    public const IS_MANAGER = 2;
    public const IS_USER = 3;
}
