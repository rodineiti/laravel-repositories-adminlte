<?php

namespace App\Repositories\Core\QueryBuilder;

use App\Repositories\Core\BaseQueryBuilderRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;

abstract class QueryBuilderCategoryRepository extends BaseQueryBuilderRepository
										implements CategoryRepositoryInterface
{
    protected $table = 'categories';

    public function search($data)
    {
    	return null;
    }
}
