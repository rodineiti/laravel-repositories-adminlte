<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Category;
use App\Repositories\Core\BaseEloquentRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class EloquentCategoryRepository extends BaseEloquentRepository 
										implements CategoryRepositoryInterface
{
    public function model()
    {
    	return Category::class;
    }

    public function search(array $data)
    {
    	return $this->model
    		->where(function ($query) use ($data) {
                if (isset($data['title'])) {
                    $query->where('title', $data['title']);
                }

                if (isset($data['description'])) {
                    $query->orWhere(
                        'description', 'LIKE', "%{$data['description']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();
    }

    public function productsByCategory(int $id)
    {
        return $this->model->find($id)->products;
    }
}
