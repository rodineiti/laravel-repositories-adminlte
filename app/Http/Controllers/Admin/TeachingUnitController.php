<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateTeachingUnitFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeachingUnit;

class TeachingUnitController extends Controller
{
    private $model;

    public function __construct(TeachingUnit $model)
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
        $units = $this->model->orderBy('id', 'DESC')->paginate(10);

        return view('admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTeachingUnitFormRequest $request)
    {
        $data = $request->all();
        
        $this->model->create($data);

        return redirect()->route('units.index')
            ->withSuccess('Unidade cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = $this->model->findOrFail($id);

        if (!$unit) {
            return redirect()->back()
                ->withWarning('Unidade não encontrada na base de dados');
        }

        return view('admin.units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = $this->model->findOrFail($id);

        if (!$unit) {
            return redirect()->back()
                ->withWarning('Unidade não encontrada na base de dados');
        }

        return view('admin.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTeachingUnitFormRequest $request, $id)
    {
        $unit = $this->model->findOrFail($id);

        if (!$unit) {
            return redirect()->back()
                ->withWarning('Unidade não encontrada na base de dados');
        }

        $data = $request->all();

        $unit->update($data);

        return redirect()->route('units.index')
            ->withSuccess('Unidade atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = $this->model->findOrFail($id);

        if (!$unit) {
            return redirect()->back()
                ->withWarning('Unidade não encontrada na base de dados');
        }

        $unit->delete();

        return redirect()->route('units.index')
            ->withSuccess('Unidade deletada com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $units = $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['title'])) {
                    $query->where(
                        'title', 'LIKE', "%{$filters['title']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('admin.units.index', compact('units', 'filters'));
    }
}
