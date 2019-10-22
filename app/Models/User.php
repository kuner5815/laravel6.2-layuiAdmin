<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Services\Administrators\PermissionService;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function link(){
        return $this->belongsToMany(RolePermissionLink::class,'id','role_id');
    }

    /**
     * 用户拥有的角色
     */
    public function permission()
    {
        return $this->belongsTo(RolePermissionLink::class);
    }

    /**
     * 获取树形菜单导航栏
     * @return array
     */
    public function getMenus()
    {
        return PermissionService::getAdminPermissionTree();
    }

}
