<?php
namespace Fast\Api\Permission\Transformers;
use Fast\Api\Permission\ArrayHelper;
use Fast\Api\Permission\Models\AdminUser;
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
           'roles'=> ArrayHelper::getColumnAsArray($item->roles()->get(), 'slug'),
           'rolesIds'=> ArrayHelper::getColumnAsArray($item->roles()->get(), 'id')
       ];
   }
}
