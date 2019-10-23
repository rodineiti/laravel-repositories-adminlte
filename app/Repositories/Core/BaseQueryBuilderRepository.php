<?php

namespace App\Repositories\Core;

use DB;
use App\Repositories\Exceptions\NotPropertyDefined;
use App\Repositories\Contracts\RepositoryInterface;

class BaseQueryBuilderRepository implements RepositoryInterface
{
	protected $tb;

	protected $orderBy = ['column' => 'id', 'order' => 'DESC'];

	public function __construct()
	{
		$this->tb = $this->resolveTable();
	}

	public function getAll()
    {
    	return DB::table($this->tb)->orderBy($this->orderBy['column'], $this->orderBy['order'])->get();
    }

	public function findById(int $id)
	{
		return DB::table($this->tb)->find($id);
	}

	public function findWhereAll($column, $value)
	{
		return DB::table($this->tb)
			->orderBy($this->orderBy['column'], $this->orderBy['order'])
			->where($column, $value)->get();
	}

	public function findWhereFirst($column, $value)
	{
		return DB::table($this->tb)->where($column, $value)->first();
	}

	public function getPaginate(int $totalPages = 10)
	{
		return DB::table($this->tb)
			->orderBy($this->orderBy['column'], $this->orderBy['order'])
			->paginate($totalPages);
	}

	public function store(array $data)
	{
		return DB::table($this->tb)->insert($data);
	}

	public function update(int $id, array $data)
	{
		$model = $this->findById($id);
		return DB::table($this->tb)->where('id', $model->id)->update($data);
	}

	public function destroy(int $id)
	{
		$model = $this->findById($id);
		return DB::table($this->tb)->where('id', $model->id)->delete();
	}

	public function orderBy($column, $order = 'DESC')
    {
        $this->orderBy['column'] = $column;
        $this->orderBy['order'] = $order;

        return $this;
    }

	public function resolveTable()
	{
		// verifica se existe a propriedade que seta a Tabela a ser trabalhada
		// que instanciar esta classe precisa passar esta propriedade
		if (!property_exists($this, 'table')) {
			throw new NotPropertyDefined;
		}

		// devolve um objeto do modelo a ser trabalhado
		return $this->table;
	}
}
