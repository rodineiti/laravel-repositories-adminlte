<?php

/*
*
* Class with ORM Eloquent
*/

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $repository;
    
    public function __construct(ProductRepositoryInterface $repository)
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
        $products = $this->repository
            ->relationships('category')
            ->orderBy('id', 'DESC')
            ->getPaginate();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        $this->repository->store([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'url' => $request->url,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')
                ->withSuccess('Produto cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->repository->findById($id);

        if (!$product) {
            return redirect()->back()
                    ->withWarning('Produto não encontrado na base de dados');
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->repository->findById($id);

        if (!$product) {
            return redirect()->back()
                    ->withWarning('Produto não encontrado na base de dados');
        }

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        $product = $this->repository->findById($id);

        if (!$product) {
            return redirect()->back()
                    ->withWarning('Produto não encontrado na base de dados');
        }

        $this->repository->update($product->id, [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'url' => $request->url,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')
                    ->withSuccess('Produto atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->repository->findById($id);

        if (!$product) {
            return redirect()->back()
                    ->withWarning('Produto não encontrado na base de dados');
        }

        $this->repository->destroy($product->id);

        return redirect()->route('products.index')
                    ->withSuccess('Produto deletado com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = $this->repository->search($request);

        return view('admin.products.index', compact('products', 'filters'));
    }
}
