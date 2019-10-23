<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

/**
 * ProductRepositoryInterface
 * additional
 */
interface ProductRepositoryInterface
{
	public function search(Request $request);
}
