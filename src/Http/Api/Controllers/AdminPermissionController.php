<?php

namespace Fast\Api\Permission\Http\Api\Controllers;

use Fast\Api\Permission\ArrayHelper;
use Fast\Api\Permission\Http\Api\Base\Controller;
use Fast\Api\Permission\Http\Api\Services\AdminPermission\AdminPermissionDeleteService;
use Fast\Api\Permission\Http\Api\Services\AdminPermission\AdminPermissionSearchService;
use Fast\Api\Permission\Http\Api\Services\AdminPermission\AdminPermissionShowService;
use Fast\Api\Permission\Http\Api\Services\AdminPermission\AdminPermissionStoreService;
use Fast\Api\Permission\Http\Api\Services\AdminPermission\AdminPermissionUpdateService;
use Fast\Api\Permission\Repository\Contract\AdminPermissionRepository;
use Fast\Api\Permission\Transformers\AdminPermissionTransformer;

class AdminPermissionController extends Controller
{
    protected $transformer;

    public function __construct(AdminPermissionTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @OA\Get(
     *      path="/api/permission",
     *      tags={"权限管理"},
     *      description="描述",
     *      @OA\Parameter(
     *          name="name",
     *          description="权限名称",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="parent_id",
     *          description="父级权限id",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AdminPermission")
     *     )
     * )
     */
    public function index(AdminPermissionSearchService $service)
    {
        return $this->response->paginator($service->search(), $this->transformer);
    }

    /**
     * @OA\Post(
     *     path="/api/permission",
     *     tags={"权限管理"},
     *     description="描述",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     description="权限名称",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     description="权限标示",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     description="权限描述",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="parent_id",
     *                     description="父级权限",
     *                     type="integer"
     *                 ),
     *                 example={"name": "用户管理", "slug": "/user", "description": "描述", "parent_id": 0}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function store(AdminPermissionStoreService $service)
    {
        return $this->response->item($service->save(), $this->transformer);
    }

    /**
     * @OA\Get (
     *      path="/api/permission/{id}",
     *      tags={"权限管理"},
     *      description="描述",
     *      @OA\Parameter(
     *          name="id",
     *          description="权限ID",
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
    public function show(AdminPermissionShowService $service, int $id)
    {
        return $this->response->item($service->show($id), $this->transformer);
    }

    /**
     * @OA\Put(
     *      path="/api/permission/{id}",
     *      tags={"权限管理"},
     *      description="描述",
     *      @OA\Parameter(
     *          name="id",
     *          description="权限ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="权限名称",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="slug",
     *          description="权限标示",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="parent_id",
     *          description="父级权限",
     *          required=false,
     *          in="query",
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
    public function update(AdminPermissionUpdateService $service, int $id)
    {
        return $this->response->item($service->update($id), $this->transformer);

    }

    /**
     * @OA\Delete (
     *      path="/api/permissions/{id}",
     *      tags={"权限管理"},
     *      description="描述",
     *      @OA\Parameter(
     *          name="id",
     *          description="权限ID",
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
    public function destroy(AdminPermissionDeleteService $service, int $id)
    {
        $service->delete($id);
    }

    /**
     * @OA\Get  (
     *      path="/api/permissions/node",
     *      tags={"权限管理"},
     *      description="描述",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                property="children",
     *                type="object",
     *                description="子元素集合",
     *                @OA\Schema(type="object")
     *             ),
     *             @OA\Property(
     *               property="label",
     *               type="string",
     *               description="权限名称",
     *               @OA\Schema(type="string")
     *            ),
     *            @OA\Property(
     *              property="value",
     *              type="integer",
     *              description="权限ID",
     *              @OA\Schema(type="string")
     *           )
     * )
     *     )
     * )
     */
    public function nodes(AdminPermissionRepository $repository)
    {
        $result = [];
        $permissions = $repository->all()->toArray();
        ArrayHelper::traversePermission($permissions, $result);
        return response()->json($result);
    }
}
