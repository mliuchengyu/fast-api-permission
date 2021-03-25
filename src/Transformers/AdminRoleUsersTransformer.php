<?php

namespace Edu\Permission\Transformers;

use Edu\Permission\Models\AdminRole;
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
