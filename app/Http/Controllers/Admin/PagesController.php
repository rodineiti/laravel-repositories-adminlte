<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePageFormRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    private $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->model->orderBy('id', 'DESC')->paginate(10);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePageFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePageFormRequest $request)
    {
        $data = $request->all();
        $data["slug"] = $request->title;

        $this->model->create($data);

        return redirect()->route('pages.index')
            ->withSuccess('Página cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = $this->model->findOrFail($id);

        if (!$page) {
            return redirect()->back()
                ->withWarning('Página não encontrada na base de dados');
        }

        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->model->findOrFail($id);

        if (!$page) {
            return redirect()->back()
                ->withWarning('Página não encontrada na base de dados');
        }

        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePageFormRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePageFormRequest $request, $id)
    {
        $page = $this->model->findOrFail($id);

        if (!$page) {
            return redirect()->back()
                ->withWarning('Página não encontrada na base de dados');
        }

        $data = $request->all();
        $data["slug"] = $page->slug;

        $page->update($data);

        return redirect()->route('pages.index')
            ->withSuccess('Página atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = $this->model->findOrFail($id);

        if (!$page) {
            return redirect()->back()
                ->withWarning('Página não encontrada na base de dados');
        }

        $page->delete();

        return redirect()->route('pages.index')
            ->withSuccess('Página deletada com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $pages = $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['title'])) {
                    $query->where(
                        'title', 'LIKE', "%{$filters['title']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('admin.pages.index', compact('pages', 'filters'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            "file" => ["required","image","mimes:jpeg,jpg,png","max:2048"]
        ]);

        $extension = $request->file("file")->extension();
        $filename = time().".".$extension;
        $request->file("file")->move(public_path("media/images"), $filename);

        return response()->json(["location" => asset("media/images/" . $filename)]);
    }
}
