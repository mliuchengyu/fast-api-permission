<?php

namespace Fast\Api\Permission\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminPermission
 *
 * @package Petstore30
 *
 * @author  liuhcnegyu@live.cn
 *
 * @OA\Schema(
 *     title="AdminPermission model",
 *     description="AdminPermission model",
 * )
 */
class AdminPermission extends Model
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
     *     description="父级权限id",
     *     title="parent_id",
     * )
     *
     * @var integer
     */
    private $parent_id;


    /**
     * @OA\Property(
     *     description="权限名称",
     *     title="name",
     * )
     *
     * @var string
     */
    private $name;


    protected $table = "admin_permissions";
    protected $fillable = ['name', 'slug', 'parent_id', 'description'];

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, "admin_role_permissions", "permission_id", "role_id")->withTimestamps();
    }

    public function child()
    {
        return $this->hasMany(AdminPermission::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->child()->with('children');
    }
}
