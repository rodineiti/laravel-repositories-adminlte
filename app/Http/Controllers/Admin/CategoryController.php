<?php

/*
*
* Class with QueryBuilder
*/

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    private $repository;
    
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->orderBy('id', 'DESC')->getPaginate();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateCategoryFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $this->repository->store([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')
                ->withSuccess('Categoria cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->repository->findById($id);

        if (!$category) {
            return redirect()->back()
                    ->withWarning('Categoria não encontrada na base de dados');
        }

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->repository->findById($id);

        if (!$category) {
            return redirect()->back()
                ->withWarning('Categoria não encontrada na base de dados');
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateCategoryFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        $category = $this->repository->findById($id);

        if (!$category) {
            return redirect()->back()
                ->withWarning('Categoria não encontrada na base de dados');
        }

        $this->repository->update($category->id, [
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')
                    ->withSuccess('Categoria atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->repository->findById($id);

        if (!$category) {
            return redirect()->back()
                ->withWarning('Categoria não encontrada na base de dados');
        }

        if (count($this->repository->productsByCategory($category->id))) {
            $count = count($this->repository->productsByCategory($category->id));
            return redirect()->back()
                ->withWarning("Não é possível deletar a categoria pois existem $count produto(s) vinculado(s) a ela.");
        }

        $this->repository->destroy($category->id);

        return redirect()->route('categories.index')
                    ->withSuccess('Categoria deletada com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $categories = $this->repository->search($filters);

        return view('admin.categories.index', compact('categories', 'filters'));
    }
}
