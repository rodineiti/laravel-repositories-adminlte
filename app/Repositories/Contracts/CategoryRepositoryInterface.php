<?php

namespace App\Repositories\Contracts;

/**
 * CategoryRepositoryInterface
 * additional
 */
interface CategoryRepositoryInterface
{
	public function search(array $data);
	public function productsByCategory(int $id);
}
