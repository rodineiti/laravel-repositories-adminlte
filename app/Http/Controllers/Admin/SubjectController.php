<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateSubjectFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    private $model;

    public function __construct(Subject $model)
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
        $subjects = $this->model->orderBy('id', 'DESC')->paginate(10);

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateSubjectFormRequest $request)
    {
        $data = $request->all();
        
        $this->model->create($data);

        return redirect()->route('subjects.index')
            ->withSuccess('Assunto cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = $this->model->findOrFail($id);

        if (!$subject) {
            return redirect()->back()
                ->withWarning('Assunto não encontrada na base de dados');
        }

        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = $this->model->findOrFail($id);

        if (!$subject) {
            return redirect()->back()
                ->withWarning('Assunto não encontrada na base de dados');
        }

        return view('admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateSubjectFormRequest $request, $id)
    {
        $subject = $this->model->findOrFail($id);

        if (!$subject) {
            return redirect()->back()
                ->withWarning('Assunto não encontrada na base de dados');
        }

        $data = $request->all();

        $subject->update($data);

        return redirect()->route('subjects.index')
            ->withSuccess('Assunto atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = $this->model->findOrFail($id);

        if (!$subject) {
            return redirect()->back()
                ->withWarning('Assunto não encontrada na base de dados');
        }

        $subject->delete();

        return redirect()->route('subjects.index')
            ->withSuccess('Assunto deletada com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $subjects = $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['title'])) {
                    $query->where(
                        'title', 'LIKE', "%{$filters['title']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('admin.subjects.index', compact('subjects', 'filters'));
    }
}
