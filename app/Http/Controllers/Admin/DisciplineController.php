<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateDisciplineFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discipline;

class DisciplineController extends Controller
{
    private $model;

    public function __construct(Discipline $model)
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
        $disciplines = $this->model->orderBy('id', 'DESC')->paginate(10);

        return view('admin.disciplines.index', compact('disciplines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.disciplines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatedisciplineFormRequest $request)
    {
        $data = $request->all();
        
        $this->model->create($data);

        return redirect()->route('disciplines.index')
            ->withSuccess('Disciplina cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discipline = $this->model->findOrFail($id);

        if (!$discipline) {
            return redirect()->back()
                ->withWarning('Disciplina não encontrada na base de dados');
        }

        return view('admin.disciplines.show', compact('discipline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discipline = $this->model->findOrFail($id);

        if (!$discipline) {
            return redirect()->back()
                ->withWarning('Disciplina não encontrada na base de dados');
        }

        return view('admin.disciplines.edit', compact('discipline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatedisciplineFormRequest $request, $id)
    {
        $discipline = $this->model->findOrFail($id);

        if (!$discipline) {
            return redirect()->back()
                ->withWarning('Disciplina não encontrada na base de dados');
        }

        $data = $request->all();

        $discipline->update($data);

        return redirect()->route('disciplines.index')
            ->withSuccess('Disciplina atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discipline = $this->model->findOrFail($id);

        if (!$discipline) {
            return redirect()->back()
                ->withWarning('Disciplina não encontrada na base de dados');
        }

        $discipline->delete();

        return redirect()->route('disciplines.index')
            ->withSuccess('Disciplina deletada com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $disciplines = $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['title'])) {
                    $query->where(
                        'title', 'LIKE', "%{$filters['title']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('admin.disciplines.index', compact('disciplines', 'filters'));
    }
}
