<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateInstitutionFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution;

class InstitutionController extends Controller
{
    private $model;

    public function __construct(Institution $model)
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
        $institutions = $this->model->orderBy('id', 'DESC')->paginate(10);

        return view('admin.institutions.index', compact('institutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateInstitutionFormRequest $request)
    {
        $data = $request->all();
        
        $this->model->create($data);

        return redirect()->route('institutions.index')
            ->withSuccess('Instituição cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institution = $this->model->findOrFail($id);

        if (!$institution) {
            return redirect()->back()
                ->withWarning('Instituição não encontrada na base de dados');
        }

        return view('admin.institutions.show', compact('institution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institution = $this->model->findOrFail($id);

        if (!$institution) {
            return redirect()->back()
                ->withWarning('Instituição não encontrada na base de dados');
        }

        return view('admin.institutions.edit', compact('institution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateInstitutionFormRequest $request, $id)
    {
        $institution = $this->model->findOrFail($id);

        if (!$institution) {
            return redirect()->back()
                ->withWarning('Instituição não encontrada na base de dados');
        }

        $data = $request->all();

        $institution->update($data);

        return redirect()->route('institutions.index')
            ->withSuccess('Instituição atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institution = $this->model->findOrFail($id);

        if (!$institution) {
            return redirect()->back()
                ->withWarning('Instituição não encontrada na base de dados');
        }

        $institution->delete();

        return redirect()->route('institutions.index')
            ->withSuccess('Instituição deletada com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $institutions = $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['title'])) {
                    $query->where(
                        'title', 'LIKE', "%{$filters['title']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('admin.institutions.index', compact('institutions', 'filters'));
    }
}
