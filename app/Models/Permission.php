<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','parent_id','route', 'type', 'sort','fonts'];
    
    public function link()
    {
        return $this->belongsToMany(Role::class,'role_permission_links')->withTimestamps();
    }
}
