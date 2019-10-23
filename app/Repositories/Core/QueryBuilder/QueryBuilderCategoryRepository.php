<?php

namespace App\Repositories\Core\QueryBuilder;

use App\Repositories\Core\BaseQueryBuilderRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class QueryBuilderCategoryRepository extends BaseQueryBuilderRepository 
										implements CategoryRepositoryInterface
{
    protected $table = 'categories';

    public function search($data)
    {
    	return null;
    }
}
