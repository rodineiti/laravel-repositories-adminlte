<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view("admin.profile");
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$user->id}"],
        ];

        if (isset($request->password) && !is_null($request->password)) {
            $rules['password'] = ['confirmed'];
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;

        if (isset($request->password) && !is_null($request->password)) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->back()
            ->withSuccess('Perfil atualizado com sucesso');
    }
}
