<?php

namespace Edu\Permission\Http\Api\Controllers;

use Edu\Permission\Http\Api\Base\Controller;
use Edu\Permission\Http\Api\Services\AdminUser\AdminUserDeleteService;
use Edu\Permission\Http\Api\Services\AdminUser\AdminUserSearchService;
use Edu\Permission\Http\Api\Services\AdminUser\AdminUserShowService;
use Edu\Permission\Http\Api\Services\AdminUser\AdminUserStoreService;
use Edu\Permission\Http\Api\Services\AdminUser\AdminUserUpdateService;
use Edu\Permission\Transformers\AdminUserTransformers;

class AdminUserController extends Controller
{
    protected $transformer;

    public function __construct(AdminUserTransformers $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @OA\Get(
     *      path="/api/users",
     *      tags={"用户管理"},
     *      description="列表",
     *      @OA\Parameter(
     *          name="name",
     *          description="用户名称",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="username",
     *          description="登录账号",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AdminUser")
     *     )
     * )
     */
    public function index(AdminUserSearchService $service)
    {
        return $this->response->paginator($service->search(), $this->transformer);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"用户管理"},
     *     description="添加",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="username",
     *                     description="登录账号",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="密码",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     description="姓名",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="mobile",
     *                     description="手机号码",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="remark",
     *                     description="描述",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="avatar",
     *                     description="头像",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="company_code",
     *                     description="XF",
     *                     type="string"
     *                 ),
     *                 example={"username": "test001","password": "123123","name": "测试账号", "mobile": "181****0406", "remark": "system init", "avatar": "https://www.baidu.com/1.jpg", "company_code": "XF"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function store(AdminUserStoreService $service)
    {
        return $this->response->item($service->save(), $this->transformer);
    }

    /**
     * @OA\Get (
     *      path="/api/users/{id}",
     *      tags={"用户管理"},
     *      description="详情",
     *      @OA\Parameter(
     *          name="id",
     *          description="用户ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AdminUser")
     *       )
     * )
     */
    public function show(AdminUserShowService $service, $id)
    {
        return $this->response->item($service->show($id), $this->transformer);
    }


    /**
     * @OA\Put(
     *      path="/api/users/{id}",
     *      tags={"用户管理"},
     *      description="更新",
     *      @OA\Parameter(
     *          name="id",
     *          description="用户ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="username",
     *          description="用户账号",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="用户密码",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="姓名",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="mobile",
     *          description="手机号码",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="rolesIds",
     *          description="拥有角色",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="object"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="remark",
     *          description="备注",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="avatar",
     *          description="头像",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="company_code",
     *          description="公司代码",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="staff_code",
     *          description="员工代码",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AdminUser")
     *       )
     * )
     */
    public function update(AdminUserUpdateService $service, $id)
    {
        return $this->response->item($service->update($id), $this->transformer);
    }

    /**
     * @OA\Delete (
     *      path="/api/users/{id}",
     *      tags={"用户管理"},
     *      description="删除",
     *      @OA\Parameter(
     *          name="id",
     *          description="用户ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       )
     * )
     */
    public function destroy(AdminUserDeleteService $service, $id)
    {
        return $service->delete($id);
    }
}
