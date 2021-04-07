<?php

namespace Fast\Api\Permission\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Class AdminMenu
 *
 * @package Petstore30
 *
 * @author  liuhcnegyu@live.cn
 *
 * @OA\Schema(
 *     title="AdminMenu model",
 *     description="AdminMenu model",
 * )
 */

class AdminMenu extends Model
{
    /**
     * @OA\Property(
     *     format="int64",
     *     description="ID",
     *     title="ID",
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="父级菜单id",
     *     title="parent_id",
     * )
     *
     * @var integer
     */
    private $parent_id;


    /**
     * @OA\Property(
     *     description="菜单名称",
     *     title="title",
     * )
     *
     * @var string
     */
    private $title;

    /**
     * @OA\Property(
     *     description="菜单路径",
     *     title="path",
     * )
     *
     * @var string
     */
    private $path;

    protected $table = "admin_menus";

    protected $fillable = ['title', 'path', 'parent_id'];

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, "admin_role_menus", "menu_id", "role_id")
            ->withTimestamps();
    }

    public function child()
    {
        return $this->hasMany(AdminMenu::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->child()->with('children');
    }

}
