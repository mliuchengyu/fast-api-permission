<?php


namespace Edu\Permission\Transformers;

use League\Fractal\TransformerAbstract;
use Edu\Permission\ArrayHelper;

class AdminPermissionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'slug' => $item->slug,
            'parent_id' => $item->parent_id,
            'children' => $item->children->map(function ($item) {
                return array_merge($item->toArray(),[
                    'roles' => ArrayHelper::getColumnAsArray($item->roles()->get(), "id"),
                ]) ;
            }),
            'hasChildren' => $item->child()->exists(),
            'description' => $item->description,
            'roles' => ArrayHelper::getColumnAsArray($item->roles()->get(), "id"),
        ];
    }
}

