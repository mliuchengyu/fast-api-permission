<?php

namespace Edu\Permission\Http\Api\Controllers;

use Edu\Permission\ArrayHelper;
use Edu\Permission\Http\Api\Base\Controller;
use Edu\Permission\Http\Api\Services\AdminRole\AdminAuthUpdateService;
use Edu\Permission\Http\Api\Services\AdminRole\AdminRoleDeleteService;
use Edu\Permission\Http\Api\Services\AdminRole\AdminRoleSearchService;
use Edu\Permission\Http\Api\Services\AdminRole\AdminRoleShowService;
use Edu\Permission\Http\Api\Services\AdminRole\AdminRoleStoreService;
use Edu\Permission\Http\Api\Services\AdminRole\AdminRoleUpdateService;
use Edu\Permission\Repository\Contract\AdminRoleRepository;
use Edu\Permission\Repository\Contract\AdminUserRepository;
use Edu\Permission\Transformers\AdminRoleTransformer;
use Edu\Permission\Transformers\AdminRoleUsersTransformer;
use Edu\Permission\Transformers\AdminUserTransformers;

class AdminRoleController extends Controller
{
    protected $transformer;

    public function __construct(AdminRoleTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @OA\Get(
     *      path="/api/role",
     *      tags={"角色管理"},
     *      description="列表",
     *      @OA\Parameter(
     *          name="name",
     *          description="角色名称",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AdminRole")
     *     )
     * )
     */
    public function index(AdminRoleSearchService $service)
    {
        return $this->response->paginator($service->search(), $this->transformer);
    }

    /**
     * @OA\Post(
     *     path="/api/role",
     *     tags={"角色管理"},
     *     description="添加",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     description="角色名称",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     description="角色标示",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     description="角色描述",
     *                     type="string"
     *                 ),
     *                 example={"name": "业务部门", "slug": "/business", "description": "system init"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function store(AdminRoleStoreService $service)
    {
        return $this->response->item($service->save(), $this->transformer);
    }

    /**
     * @OA\Post(
     *     path="/api/role/apply/{id}",
     *     tags={"角色管理"},
     *     description="授权",
     *      @OA\Parameter(
     *          name="id",
     *          description="角色ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="permissions",
     *                     description="权限ids",
     *                     type="string"
     *                 ),
     *                 example={"permissions": {1,2,3}}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function apply(AdminAuthUpdateService $service, $id)
    {
        return $this->response->item($service->update($id), $this->transformer);
    }

    /**
     * @OA\Get (
     *      path="/api/role/{id}",
     *      tags={"角色管理"},
     *      description="详情",
     *      @OA\Parameter(
     *          name="id",
     *          description="角色ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AdminRole")
     *       )
     * )
     */
    public function show(AdminRoleShowService $service, $id)
    {
        return $this->response->item($service->show($id), $this->transformer);
    }

    /**
     * @OA\Put(
     *      path="/api/role/{id}",
     *      tags={"角色管理"},
     *      description="更新",
     *      @OA\Parameter(
     *          name="id",
     *          description="角色ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="角色名称",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="slug",
     *          description="角色标示",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AdminRole")
     *       )
     * )
     */
    public function update(AdminRoleUpdateService $service, $id)
    {
        return $this->response->item($service->update($id), $this->transformer);
    }

    /**
     * @OA\Delete (
     *      path="/api/role/{id}",
     *      tags={"角色管理"},
     *      description="删除",
     *      @OA\Parameter(
     *          name="id",
     *          description="角色ID",
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
    public function destroy(AdminRoleDeleteService $service, $id)
    {
        $service->delete($id);
    }

    /**
     * @OA\Get(
     *      path="/api/roles_users",
     *      tags={"角色管理"},
     *      description="角色用户列表",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(example={"id": 3, "name": "业务员"})
     *     )
     * )
     */
    public function nodes(AdminUserRepository $repository)
    {
        $user = \Auth::guard()->user();
        $userIds = [];
        foreach ($user->roles()->get() as $item){
            $userIds = array_merge($userIds, ArrayHelper::getColumnAsArray($item->roleUser()->get(), 'id'));
        }
        $result = $repository->findWhereIn('id',array_unique($userIds));
        return $this->response->collection($result,new AdminRoleUsersTransformer());
    }
}
