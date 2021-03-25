# Laravel And fast-api/permission
fast-api-permission 为laravel 框架服务开发工具，基于 fast-api-permission 可对前后端API接口RBAC权限进行管理。
更多功能可以参考下面的文档。

在Laravel应用程序中使用官方fast-api/permission客户端的简便方法。



- [安装与配置](#安装与配置)
    - [安装 Laravel](#安装-Laravel)
        - [安装 fast-api/permission](#安装-权限扩展包)
        - [配置 laravel .env 文件](#配置-laravel-env-文件)
        - [配置 laravel auth 文件](#配置-laravel-auth-文件)
- [使用](#使用)
- [控制台命令](#console-commands)
- [bug、建议、贡献和支持](#bug-建议-贡献和支持)
- [文档](#文档)
- [存储库](#存储库)
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
        'model' => \Edu\Permission\User::class,
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
发布配置 [Captcha]

运行以下命令以发布程序包配置文件：

```sh
php artisan vendor:publish --provider="Mews\Captcha\CaptchaServiceProvider"
```

## bug 建议 贡献和支持

请使用[Github](https://github.com/fast-php/fast-api-permission)报告bug，并提出意见或建议。

请参阅[CONTRIBUTING.md](CONTRIBUTING.md)了解如何贡献更改。


## 文档
PHP开发技术交流（QQ群 368868750）

[![PHP开发技术交流 (SDK)](http://pub.idqqimg.com/wpa/images/group.png)](https://qm.qq.com/cgi-bin/qm/qr?k=rfRumoZ0fxUN4TdshfjkxiHximnHVSzb&jump_from=webapi)

> fast-api-permission 是基于laravel 7.x 封装，在做项目开发前，必需先阅读laravel官方文档。
>* laravel 官方文档：https://learnku.com/docs/laravel/7.x/releases/7444

## 存储库
fast-api-permission 为开源项目，允许把它用于任何地方，不受任何约束，欢迎 fork 项目。
>* GitHub 托管地址：https://github.com/fast-php/fast-api-permission
>* packagist 托管地址：https://packagist.org/packages/fast-api/permission
> 
## 版权和许可

[fast-api/permission](https://github.com/fast-php/fast-api-permission)
was written by [fast-php](http://www.dnat.link) and is released under the
[MIT License](LICENSE.md).

Copyright (c) 2015 fast-php