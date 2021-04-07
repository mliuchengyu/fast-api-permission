<?php

namespace Fast\Api\Permission\Models;

use Fast\Api\Permission\ArrayHelper;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminUser
 * @OA\Schema(
 *     title="AdminUser model",
 *     description="AdminUser model",
 * )
 */
class AdminUser extends Model
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
     *     description="账号",
     *     title="title",
     * )
     *
     * @var string
     */
    private $username;

    /**
     * @OA\Property(
     *     description="密码",
     *     title="title",
     * )
     *
     * @var string
     */
    private $password;

    /**
     * @OA\Property(
     *     description="姓名",
     *     title="title",
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     description="手机号码",
     *     title="title",
     * )
     *
     * @var string
     */
    private $mobile;

    /**
     * @OA\Property(
     *     description="备注",
     *     title="title",
     * )
     *
     * @var string
     */
    private $remark;


    /**
     * @OA\Property(
     *     description="头像",
     *     title="title",
     * )
     *
     * @var string
     */
    private $avatar;

    /**
     * @OA\Property(
     *     description="公司代码",
     *     title="title",
     * )
     *
     * @var string
     */
    private $company_code;

    /**
     * @OA\Property(
     *     description="员工代码",
     *     title="title",
     * )
     *
     * @var string
     */
    private $staff_code;

    protected $table = "admin_users";

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['username','password', 'name', 'mobile', 'remark', 'company_code', 'staff_code'];

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_role_users', 'user_id', 'role_id')
            ->withTimestamps();
    }

    public function roleSlugs()
    {
         return ArrayHelper::getColumnAsArray($this->roles()->get(), 'slug');
    }
}
