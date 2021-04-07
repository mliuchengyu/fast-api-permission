<?php

namespace Fast\Api\Permission\Http\Api\Controllers;

use Fast\Api\Permission\ArrayHelper;
use Fast\Api\Permission\Http\Api\Base\Controller;
use Fast\Api\Permission\Http\Api\Services\AdminMenu\AdminMenuDeleteService;
use Fast\Api\Permission\Http\Api\Services\AdminMenu\AdminMenuSearchService;
use Fast\Api\Permission\Http\Api\Services\AdminMenu\AdminMenuShowService;
use Fast\Api\Permission\Http\Api\Services\AdminMenu\AdminMenuStoreService;
use Fast\Api\Permission\Http\Api\Services\AdminMenu\AdminMenuUpdateService;
use Fast\Api\Permission\Transformers\AdminMenuTransformer;
use Fast\Api\Permission\Repository\Contract\AdminMenuRepository;

class AdminMenuController extends Controller
{
    protected $transformer;

    public function __construct(AdminMenuTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @OA\Get(
     *      path="/api/menus",
     *      tags={"菜单管理"},
     *      description="菜单列表",
     *      @OA\Parameter(
     *          name="title",
     *          description="菜单名称",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="parent_id",
     *          description="父级菜单id",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AdminMenu")
     *     )
     * )
     */
    public function index(AdminMenuSearchService $service)
    {
        return $this->response->paginator($service->search(), $this->transformer);
    }

    /**
     * @OA\Post(
     *     path="/api/menus",
     *     tags={"菜单管理"},
     *     description="添加菜单",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     description="菜单名称",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="path",
     *                     description="菜单路径",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="parent_id",
     *                     description="父级菜单",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="roles",
     *                     description="权限ID",
     *                     type="object"
     *                 ),
     *                 example={"title": "菜单管理", "path": "/order", "parent_id": 0, "roles": {}}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function store(AdminMenuStoreService $service)
    {
        return $this->response->item($service->save(), $this->transformer);
    }

    /**
     * @OA\Get (
     *      path="/api/menus/{id}",
     *      operationId="getProjectById",
     *      tags={"菜单管理"},
     *      description="描述",
     *      @OA\Parameter(
     *          name="id",
     *          description="菜单ID",
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
    public function show(AdminMenuShowService $service, $id)
    {
        return $this->response->item($service->show($id), $this->transformer);
    }

    /**
     * @OA\Put(
     *      path="/api/permissions/{id}",
     *      tags={"菜单管理"},
     *      description="描述",
     *      @OA\Parameter(
     *          name="id",
     *          description="菜单ID",
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
    public function update(AdminMenuUpdateService $service, $id)
    {
        return $this->response->item($service->update($id), $this->transformer);

    }

    /**
     * @OA\Delete (
     *      path="/api/menus/{id}",
     *      tags={"菜单管理"},
     *      description="描述",
     *      @OA\Parameter(
     *          name="id",
     *          description="菜单ID",
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
    public function destroy(AdminMenuDeleteService $service, $id)
    {
        $service->delete($id);
    }

    /**
     * @OA\Get  (
     *      path="/api/menus/node",
     *      tags={"菜单管理"},
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
     *               description="菜单名称",
     *               @OA\Schema(type="string")
     *            ),
     *            @OA\Property(
     *              property="value",
     *              type="integer",
     *              description="菜单ID",
     *              @OA\Schema(type="string")
     *           )
     * )
     *
     *     )
     * )
     */
    public function nodes(AdminMenuRepository $repository)
    {
        $result = [];
        $menus = $repository->all()->toArray();
        ArrayHelper::traverseMenu($menus, $result);
        return response()->json($result);
    }
}
