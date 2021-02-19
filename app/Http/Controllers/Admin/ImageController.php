<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreImageFormRequest;
use App\Http\Requests\UpdateImageFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    private $model;

    public function __construct(Image $model)
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
        $images = $this->model->orderBy('id', 'DESC')->paginate(10);

        return view('admin.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageFormRequest $request)
    {
        $data = $request->all();
        
        $this->model->create($data);

        return redirect()->route('images.index')
            ->withSuccess('Image cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = $this->model->findOrFail($id);

        if (!$image) {
            return redirect()->back()
                ->withWarning('Image não encontrada na base de dados');
        }

        return view('admin.images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = $this->model->findOrFail($id);

        if (!$image) {
            return redirect()->back()
                ->withWarning('Image não encontrada na base de dados');
        }

        return view('admin.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageFormRequest $request, $id)
    {
        $image = $this->model->findOrFail($id);

        if (!$image) {
            return redirect()->back()
                ->withWarning('Image não encontrada na base de dados');
        }

        $data = $request->all();

        $image->update($data);

        return redirect()->route('images.index')
            ->withSuccess('Image atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = $this->model->findOrFail($id);

        if (!$image) {
            return redirect()->back()
                ->withWarning('Image não encontrada na base de dados');
        }

        $image->delete();

        return redirect()->route('images.index')
            ->withSuccess('Image deletada com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $images = $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['title'])) {
                    $query->where(
                        'title', 'LIKE', "%{$filters['title']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('admin.images.index', compact('images', 'filters'));
    }
}
