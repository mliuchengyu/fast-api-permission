<?php

namespace Fast\Api\Permission\Models;

use Fast\Api\Permission\ArrayHelper;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminRole
 * @OA\Schema(
 *     title="AdminRole model",
 *     description="AdminRole model",
 * )
 */
class AdminRole extends Model
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
     *     description="角色名称",
     *     title="title",
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     description="角色标示",
     *     title="title",
     * )
     *
     * @var string
     */
    private $slug;

    /**
     * @OA\Property(
     *     description="描述",
     *     title="title",
     * )
     *
     * @var string
     */
    private $description;

    protected $table = "admin_roles";
    protected $fillable = ['name', 'slug', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class, "admin_role_permissions", "role_id", "permission_id")->withTimestamps();
    }

    public function permissionSlugs()
    {
        return ArrayHelper::getColumnAsArray($this->permissions()->get(), 'slug');
    }

    public function roleUser(){
        return $this->belongsToMany(AdminUser::class, "admin_role_users", "role_id", "user_id")->withTimestamps();
    }

}
