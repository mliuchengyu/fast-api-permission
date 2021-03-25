<?php
namespace Edu\Permission\Transformers;
use Edu\Permission\ArrayHelper;
use Edu\Permission\Models\AdminUser;
use League\Fractal\TransformerAbstract;

class AdminUserTransformers extends TransformerAbstract
{
   public function transform(AdminUser $item){
       return [
           'id'=> $item->id,
           'username'=> $item->username,
           'mobile'=> $item->mobile,
           'remark'=> $item->remark,
           'name'=> $item->name,
           'avatar'=> $item->avatar,
           'company_code'=> $item->company_code,
           'staff_code'=> $item->staff_code,
           'roles'=> ArrayHelper::getColumnAsArray($item->roles()->get(), 'slug'),
           'rolesIds'=> ArrayHelper::getColumnAsArray($item->roles()->get(), 'id')
       ];
   }
}
