<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name','50')->comment('权限名');
            $table->string('route')->nullable(true)->comment('权限路由');
            $table->integer('parent_id')->comment('上级权限');
            $table->tinyInteger('sort')->comment('排序');
            $table->tinyInteger('type')->comment('类型');
            $table->string('fonts')->nullable(true)->comment('图标');
            $table->timestamps();
        });

        \DB::insert("INSERT INTO `permissions` VALUES ('1', '主页', 'main.index', '0', '1', '1', 'layui-icon-home', '2019-10-21 04:52:00', '2019-10-21 04:52:00')");
        \DB::insert("INSERT INTO `permissions` VALUES ('2', '权限管理', null, '0', '2', '1', 'layui-icon-set', '2019-10-21 04:52:31', '2019-10-21 04:52:31')");
        \DB::insert("INSERT INTO `permissions` VALUES ('3', '管理员', 'admins.index', '2', '1', '2', 'desktop', '2019-10-21 04:54:21', '2019-10-21 04:54:21')");
        \DB::insert("INSERT INTO `permissions` VALUES ('4', '角色', 'roles.index', '2', '2', '2', null, '2019-10-21 04:55:04', '2019-10-21 04:55:04')");
        \DB::insert("INSERT INTO `permissions` VALUES ('5', '权限', 'permissions.index', '2', '3', '2', null, '2019-10-21 04:55:20', '2019-10-21 04:55:20')");
        \DB::insert("INSERT INTO `permissions` VALUES ('6', '控制台', 'console.index', '1', '1', '2', null, '2019-10-21 05:59:29', '2019-10-21 05:59:29')");
        \DB::insert("INSERT INTO `permissions` (`id`, `name`, `route`, `parent_id`, `sort`, `type`, `fonts`, `created_at`, `updated_at`) VALUES ('7', '添加(页面)', 'permissions.create', '5', '1', '3', 'layui-icon-face-smile', '2019-10-22 00:49:48', '2019-10-22 00:49:48')");
        \DB::insert("INSERT INTO `permissions` (`id`, `name`, `route`, `parent_id`, `sort`, `type`, `fonts`, `created_at`, `updated_at`) VALUES ('8', '添加(执行)', 'permissions.store', '5', '2', '3', 'layui-icon-face-smile', '2019-10-22 00:50:16', '2019-10-22 00:50:16')");
        \DB::insert("INSERT INTO `permissions` (`id`, `name`, `route`, `parent_id`, `sort`, `type`, `fonts`, `created_at`, `updated_at`) VALUES ('9', '编辑(页面)', 'permissions.edit', '5', '3', '3', 'layui-icon-face-smile', '2019-10-22 00:50:43', '2019-10-22 00:50:43')");
        \DB::insert("INSERT INTO `permissions` (`id`, `name`, `route`, `parent_id`, `sort`, `type`, `fonts`, `created_at`, `updated_at`) VALUES ('10', '编辑(执行)', 'permissions.update', '5', '4', '3', 'layui-icon-face-smile', '2019-10-22 00:51:07', '2019-10-22 00:51:07')");
        \DB::insert("INSERT INTO `permissions` (`id`, `name`, `route`, `parent_id`, `sort`, `type`, `fonts`, `created_at`, `updated_at`) VALUES ('11', '删除', 'permissions.destroy', '5', '5', '3', 'layui-icon-face-smile', '2019-10-22 00:51:33', '2019-10-22 00:51:33')");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
