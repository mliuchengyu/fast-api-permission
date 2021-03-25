<?php

namespace Edu\Permission;

use Edu\Permission\Http\Api\Middleware\RbacAuthenticate;
use Edu\Permission\Repository\Contract\AdminMenuRepository;
use Edu\Permission\Repository\Contract\AdminPermissionRepository;
use Edu\Permission\Repository\Contract\AdminRoleRepository;
use Edu\Permission\Repository\Contract\AdminUserRepository;
use Edu\Permission\Repository\Eloquent\AdminMenuRepositoryEloquent;
use Edu\Permission\Repository\Eloquent\AdminPermissionRepositoryEloquent;
use Edu\Permission\Repository\Eloquent\AdminRoleRepositoryEloquent;
use Edu\Permission\Repository\Eloquent\AdminUserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * The middleware aliases.
     *
     * @var array
     */
    protected $middlewareAliases = [
        'rbac.auth'=> RbacAuthenticate::class
    ];
    /**
     * 设定所有的容器绑定的对应关系
     *
     * @var array
     */
    public $bindings = [
        AdminUserRepository::class => AdminUserRepositoryEloquent::class,
        AdminPermissionRepository::class=> AdminPermissionRepositoryEloquent::class,
        AdminRoleRepository::class=> AdminRoleRepositoryEloquent::class,
        AdminMenuRepository::class=> AdminMenuRepositoryEloquent::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->aliasMiddleware();
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
        $router = $this->app['router'];

        $method = method_exists($router, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';

        foreach ($this->middlewareAliases as $alias => $middleware) {
            $router->$method($alias, $middleware);
        }
    }
}
