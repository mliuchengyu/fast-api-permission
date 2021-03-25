<?php
namespace Edu\Permission\Http\Api\Base;

use Illuminate\Foundation\Http\FormRequest;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class AbstractSearchService
{
    /**
     * @var FormRequest
     */
    protected $request;

    /**
     * @var BaseRepository
     */
    protected $repository;


    protected $customCriteria = true;

    abstract protected function getSearchCriteriaClassName(): string ;

    abstract protected function getOrConditionFields() : array ;

    abstract protected function getAndConditionFields() : array ;

    protected function getSearchKeywordName()
    {
        return 'keyword';
    }
    protected function guard()
    {
        $this->request->validated();
    }
    public function search()
    {
        $this->guard();
        $this->repository->pushCriteria($this->getSearchCriteria());
        $limit = $this->request->input('per_page');
        return $this->repository->paginate($limit);
    }

    protected function getSearchCriteria()
    {
        if ($this->customCriteria){
            $className = $this->getSearchCriteriaClassName();
            return new $className($this->getOrConditions(), $this->getAndConditions(), $this->getOrders());
        }
        return app(RequestCriteria::class);
    }

    protected function getOrders()
    {
        $orders = [];
        if ($this->request->filled('sort_order')){
            $orders[$this->request->input('sort_column')] = $this->request->input('sort_order');
        }
        return $orders;
    }

    protected function getAndConditions()
    {
        return array_intersect_key(array_filter($this->request->input(), function ($val){
            return !is_null($val);
        }), array_fill_keys($this->getAndConditionFields(), ''));
    }

    protected function getOrConditions()
    {
        return $this->request->filled($this->getSearchKeywordName()) ?
            array_fill_keys($this->getOrConditionFields(), $this->request->input($this->getSearchKeywordName()))
            : [];
    }

}
