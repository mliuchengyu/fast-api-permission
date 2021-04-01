# fast-api/permission
fast-api-permission 是一个PHP RBAC处理和操作库，它提供了一种更容易表达的方式来创建，编辑和管理前后端分离API接口权限。该软件包包括用于轻松集成Laravel的ServiceProviders和Facades 。

更多功能可以参考下面的文档。

在Laravel应用程序中使用官方fast-api/permission客户端的简便方法。



- [安装与配置](#安装与配置)
    - [安装 Laravel](#安装-Laravel)
        - [安装 fast-api/permission](#安装-权限扩展包)
        - [配置 laravel .env 文件](#配置-laravel-env-文件)
        - [配置 laravel auth 文件](#配置-laravel-auth-文件)
- [使用](#使用)
- [启动](#启动)
- [文档](#文档)
- [演示](#演示)
- [存储库](#存储库)
- [bug、建议、贡献和支持](#bug-建议-贡献和支持)
- [版权和许可](#版权和许可)


## 安装与配置

<h1 align="center">Fast-php Cloud Fast-api/Permission SDK for Laravel</h1>

## 安装 Laravel

本产品依赖Laravel需要安装 Laravel `laravel/laravel` package via composer:

```sh
composer create-project --prefer-dist laravel/laravel laravel "7.30.0"
```

## 安装 权限扩展包

```sh
composer require fast-api/permission dev-master
```

## 配置 laravel env 文件

在按照上面建议的完成程序的安装之后，下面请配置数据库
通过添加以下内容到您的应用程序'.env文件(带有合适的值):

APP_URL 服务地址和端口:
项目访问地址，本地开发,参考设置（php artisan serve）终端执行打印信息。

```ini
APP_URL=http://localhost:8000
```

数据库:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fast-api
DB_USERNAME=root
DB_PASSWORD=root
```
API前缀:

如果您曾经使用过API，就会知道大多数服务都是通过子域或前缀提供的。前缀或子域是必需的，但只有一个。避免将版本号作为前缀或子域，因为版本控制是通过Accept标头处理的。
您可以在.env文件中进行配置。

```ini
API_PREFIX=api
```

## 配置 laravel auth 文件
```php
// Authentication Defaults
'defaults' => [
    'guard' => 'api',
    'passwords' => 'users',
]

// Authentication Guards
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
        'hash' => false,
    ],
]

// User Providers
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => \Fast\Api\Permission\User::class,
    ],

    // 'users' => [
    //     'driver' => 'database',
    //     'table' => 'users',
    // ],
]
```

## 使用
发布配置 [JWT]

运行以下命令以发布程序包配置文件：

```sh
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```
生成密钥

我提供了一个帮助程序命令，可以为您生成密钥：
```sh
php artisan jwt:secret
```
过期时间:

设置 JWT TOKEN 默认过期时间

您可以在.env文件中进行配置。

```ini
JWT_EXPIRR_IN = 1440
```

发布配置 [Captcha]

运行以下命令以发布程序包配置文件：

```sh
php artisan vendor:publish --provider="Mews\Captcha\CaptchaServiceProvider"
```

更新config/captcha.php文档配置：
```php
'default' => [
    'length' => 4,
    'width' => 150,
    'height' => 47,
    'quality' => 50,
    'math' => false,
    'expire' => 60,
    'encrypt' => false,
]
```

发布配置 [Swagger]
```sh
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
```
更新config/l5-swagger.php文档配置：

包含权限扩展包文档路径，vendor/fast-api

```php
/*
 * Absolute paths to directory containing the swagger annotations are stored.
*/
'annotations' => [
    base_path('app'),
    base_path('vendor/fast-api'),
]
```
.env 文件中配置Swagger参数。

```ini
L5_SWAGGER_GENERATE_ALWAYS=true
L5_SWAGGER_CONST_HOST=http://127.0.0.1:8000
```

数据迁移 [migrates]

运行以下命令以发布程序包配置文件：

```sh
php artisan migrate --path=vendor/fast-api/permission/database/migrations
```

生成数据 [seed]

运行以下命令导入权限数据到数据库：

```sh
php artisan db:seed --class=AdminUserSeeder
```

## bug 建议 贡献和支持

请使用[Github](https://github.com/fast-php/fast-api-permission)报告bug，并提出意见或建议。

请参阅[CONTRIBUTING.md](CONTRIBUTING.md)了解如何贡献更改。

## 启动
运行以下命令启动项目：

```sh
php artisan serve
```

API文档访问地址:

http://127.0.0.1:8000/api/documentation

## 文档
PHP开发技术交流（QQ群 368868750）

[![PHP开发技术交流 (SDK)](http://pub.idqqimg.com/wpa/images/group.png)](https://qm.qq.com/cgi-bin/qm/qr?k=rfRumoZ0fxUN4TdshfjkxiHximnHVSzb&jump_from=webapi)

> fast-api-permission 是基于laravel 7.x 封装，在做项目开发前，必需先阅读laravel官方文档。
>* laravel 官方文档：https://learnku.com/docs/laravel/7.x/releases/7444

## 演示
后台地址：https://fast-admin.dnat.link
> 账号: admin
> 
> 密码: 123123

API文档：https://fast-api.dnat.link/api/documentation


## 存储库
fast-api-permission 为开源项目，允许把它用于任何地方，不受任何约束，欢迎 fork 项目。
>* GitHub 托管地址：https://github.com/fast-oopdev/fast-api-permission
>* packagist 托管地址：https://packagist.org/packages/fast-api/permission
> 
## 版权和许可

[fast-api/permission](https://github.com/fast-oopdev/fast-api-permission)
was written by [fast-php](http://www.dnat.link) and is released under the
[MIT License](LICENSE.md).

Copyright (c) 2021 fast-php