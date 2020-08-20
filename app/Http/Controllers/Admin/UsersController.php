<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $model;

    public function __construct(User $model)
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
        $users = $this->model->orderBy('id', 'DESC')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUserFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserFormRequest $request)
    {
        $this->model->create($request->all());

        return redirect()->route('users.index')
            ->withSuccess('Usuário cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->model->findOrFail($id);

        if (!$user) {
            return redirect()->back()
                ->withWarning('Usuário não encontrado na base de dados');
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->model->findOrFail($id);

        if (!$user) {
            return redirect()->back()
                ->withWarning('Usuário não encontrado na base de dados');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->model->findOrFail($id);

        if (!$user) {
            return redirect()->back()
                ->withWarning('Usuário não encontrado na base de dados');
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$user->id}"],
            "admin" => ["required"]
        ];

        if (isset($request->password) && !is_null($request->password)) {
            $rules['password'] = ['confirmed'];
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->admin = $request->admin;

        if (isset($request->password) && !is_null($request->password)) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->route('users.index')
            ->withSuccess('Usuário atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->model->findOrFail($id);

        if (!$user) {
            return redirect()->back()
                ->withWarning('Usuário não encontrado na base de dados');
        }

        if (auth()->user()->id === $user->id) {
            return redirect()->back()
                ->withWarning('Você não pode deletar seu próprio usuário');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess('Usuário deletado com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $users = $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['name'])) {
                    $query->where(
                        'name', 'LIKE', "%{$filters['name']}%"
                    );
                }

                if (isset($filters['email'])) {
                    $query->orWhere(
                        'email', 'LIKE', "%{$filters['email']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('admin.users.index', compact('users', 'filters'));
    }
}
