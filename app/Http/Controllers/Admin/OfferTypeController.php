<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateOfferTypeFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferType;

class OfferTypeController extends Controller
{
    private $model;

    public function __construct(OfferType $model)
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
        $offertypes = $this->model->orderBy('id', 'DESC')->paginate(10);

        return view('admin.offertypes.index', compact('offertypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateOfferTypeFormRequest $request)
    {
        $data = $request->all();
        
        $this->model->create($data);

        return redirect()->route('offertypes.index')
            ->withSuccess('Tipo de oferta cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = $this->model->findOrFail($id);

        if (!$offer) {
            return redirect()->back()
                ->withWarning('Tipo de oferta não encontrada na base de dados');
        }

        return view('admin.offertypes.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = $this->model->findOrFail($id);

        if (!$offer) {
            return redirect()->back()
                ->withWarning('Tipo de oferta não encontrada na base de dados');
        }

        return view('admin.offertypes.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateOfferTypeFormRequest $request, $id)
    {
        $offer = $this->model->findOrFail($id);

        if (!$offer) {
            return redirect()->back()
                ->withWarning('Tipo de oferta não encontrada na base de dados');
        }

        $data = $request->all();

        $offer->update($data);

        return redirect()->route('offertypes.index')
            ->withSuccess('Tipo de oferta atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = $this->model->findOrFail($id);

        if (!$offer) {
            return redirect()->back()
                ->withWarning('Tipo de oferta não encontrada na base de dados');
        }

        $offer->delete();

        return redirect()->route('offertypes.index')
            ->withSuccess('Tipo de oferta deletada com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $offertypes = $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['title'])) {
                    $query->where(
                        'title', 'LIKE', "%{$filters['title']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('admin.offertypes.index', compact('offertypes', 'filters'));
    }
}
