<?php


namespace Edu\Permission\Transformers;

use Edu\Permission\ArrayHelper;
use League\Fractal\TransformerAbstract;


class AdminMenuTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform($item)
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'path' => $item->path,
            'parent_id' => $item->parent_id,
            'hasChildren' => $item->child()->exists(),
            'roles' => ArrayHelper::getColumnAsArray($item->roles()->get(), "id"),
            'roleSlugs' => ArrayHelper::getColumnAsArray($item->roles()->get(), "slug"),
            'children' => $item->children->map(function ($item) {
                foreach ($item->children as $children){
                    $children->roles = ArrayHelper::getColumnAsArray($children->roles()->get(), "id");
                    $children->roleSlugs = ArrayHelper::getColumnAsArray($children->roles()->get(), "slug");
                }
                return array_merge($item->toArray(),[
                    'path' => $item->path,
                    'roles' => ArrayHelper::getColumnAsArray($item->roles()->get(), "id"),
                    'roleSlugs' => ArrayHelper::getColumnAsArray($item->roles()->get(), "slug"),
                ]) ;
            }),
        ];
    }
}
