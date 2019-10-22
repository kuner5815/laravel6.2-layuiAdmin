<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'remark', 'sort'
    ];
    
    public function link()
    {
        return $this->belongsToMany(Permission::class,RolePermissionLink::class)->withTimestamps();
    }
}
