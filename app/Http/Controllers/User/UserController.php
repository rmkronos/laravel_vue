<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(4);
        return inertia('users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        return inertia('users/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validado = $request->validate(
            [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.unique' => 'O email informado já está em uso.',
                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'A senha deve ter no mínimo :min caracteres.',
                'password.confirmed' => 'A confirmação da senha não corresponde.',
            ]
        );

        $user = User::create([
            'name' => $validado['name'],
            'email' => $validado['email'],
            'password' => $validado['password'],
        ]);
        
        return redirect()->route('users.show',['user'=>$user->id])->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
        return inertia('users/Show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
   
        return inertia('users/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Request $request)
    {
        // Implement the logic to update the user with the given ID
        
        $validado = $request->validate(
            [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.unique' => 'O email informado já está em uso.',
            ]
        );
        
        $user->update([
            'name' => $validado['name'],
            'email' => $validado['email'],            
        ]);

        return redirect()->route('users.show',['user'=>$user->id])->with('success', 'Usuário atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário removido com sucesso!');
    }
}
