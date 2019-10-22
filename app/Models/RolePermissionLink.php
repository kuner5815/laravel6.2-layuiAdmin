<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RolePermissionLink extends Model
{
    protected $fillable = [
        'name', 'remark', 'order'
    ];

}
