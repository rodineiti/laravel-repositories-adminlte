<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
	public function getAll();
	public function getPaginate(int $totalPages = 10);
	public function findById(int $id);
	public function findWhereAll($column, $value);
	public function findWhereFirst($column, $value);
	public function store(array $data);
	public function update(int $id, array $data);
	public function destroy(int $id);
	public function orderBy($column, $order = 'DESC');
}
