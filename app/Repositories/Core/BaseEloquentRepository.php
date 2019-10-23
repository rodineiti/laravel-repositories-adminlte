<?php

namespace App\Repositories\Core;

use App\Repositories\Exceptions\NotModelDefined;
use App\Repositories\Contracts\RepositoryInterface;

class BaseEloquentRepository implements RepositoryInterface
{
	protected $model;

	public function __construct()
	{
		$this->model = $this->resolveModel();
	}

    public function getAll()
    {
    	return $this->model->all();
    }

	public function findById(int $id)
	{
		return $this->model->find($id);
	}

	public function findWhereAll($column, $value)
	{
		return $this->model->where($column, $value)->get();
	}

	public function findWhereFirst($column, $value)
	{
		return $this->model->where($column, $value)->first();
	}

	public function getPaginate(int $totalPages = 10)
	{
		return $this->model->paginate($totalPages);
	}

	public function store(array $data)
	{
		return $this->model->create($data);
	}

	public function update(int $id, array $data)
	{
		$model = $this->findById($id);

		return $model->update($data);
	}

	public function destroy(int $id)
	{
		return $this->findById($id)->delete();
	}

	public function relationships(...$relationships)
	{
		$this->model = $this->model->with($relationships);

		return $this;
	}

	public function orderBy($column, $order = 'DESC')
	{
		$this->model = $this->model->orderBy($column, $order);

		return $this;
	}

	public function resolveModel()
	{
		// verifica se existe o método que seta a Model a ser trabalhada
		// que instanciar esta classe precisa passar este método
		if (!method_exists($this, 'model')) {
			throw new NotModelDefined;
		}

		// devolve um objeto do modelo a ser trabalhado
		return app($this->model());
	}
}
