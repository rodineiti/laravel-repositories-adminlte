<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Core\BaseEloquentRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;

class EloquentProductRepository extends BaseEloquentRepository 
										implements ProductRepositoryInterface
{
    public function model()
    {
    	return Product::class;
    }

    public function search(Request $request)
    {
    	$filters = $request->except('_token');
    	
    	return $this->model
    		->with('category')
            ->where(function ($query) use ($filters) {
                if (isset($filters['item'])) {
                    $query->where(function($sq) use ($filters) {
                        $sq->where('name', $filters['item'])
                            ->orWhere(
                                'description', 'LIKE', "%{$filters['item']}%"
                            );
                    });
                }

                if (isset($filters['price'])) {
                    $query->where('price', $filters['price']);
                }

                if (isset($filters['category'])) {
                    $query->orWhere('category_id', $filters['category']);
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();
    }
}
