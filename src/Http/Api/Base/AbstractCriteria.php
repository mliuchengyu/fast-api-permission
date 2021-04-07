<?php
namespace Fast\Api\Permission\Http\Api\Base;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

abstract class AbstractCriteria implements CriteriaInterface
{
    protected $orCondition;
    protected $andCondition;
    protected $orders;
    public function __construct($orCondition= [], $andCondition = [], $orders = [])
    {
        $this->orCondition = $orCondition;
        $this->andCondition = $andCondition;
        $this->orders = $orders;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        // TODO: Implement apply() method.
        $tableName = $model->getTable();
        foreach ($this->andCondition as $field=>$condition) {
            $model = $model->where($tableName.".".$field, $condition);
        }
        $model = $model->where(function ($query) use ($tableName){
            foreach ($this->orCondition as $field => $condition){
                $query->orWhere($tableName.".".$field, 'like', "%$condition%");
            }
        });
        $model = $this->order($model, $tableName);
        return $model;
    }
    protected function order($model, $tableName)
    {
        foreach ($this->orders as $field => $order) {
            $model = $model->orderBy($tableName.'.'.$field, $order);
        }
        return $model;
    }
}
