## About migrates
migrates 数据迁移

生成数据迁移
php artisan migrate --path=packages/edu-admin-permission/database/migrations

数据回滚
php artisan migrate:rollback --path=packages/edu-admin-permission/database/migrations

生成数据
php artisan db:seed --class=AdminUserSeeder
