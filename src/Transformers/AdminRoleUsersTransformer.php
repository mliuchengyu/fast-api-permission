<?php

namespace Fast\Api\Permission\Transformers;

use Fast\Api\Permission\Models\AdminRole;
use League\Fractal\TransformerAbstract;

class AdminRoleUsersTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
        ];
    }
}
