<?php

namespace Fast\Api\Permission\Transformers;

use Fast\Api\Permission\ArrayHelper;
use League\Fractal\TransformerAbstract;

class AdminRoleTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'slug' => $item->slug,
            'description' => $item->description,
            'permissions' => ArrayHelper::getColumnAsArray($item->permissions()->get(),"id")
        ];
    }
}
