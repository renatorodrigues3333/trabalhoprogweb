<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterArenaOwnerController extends Controller
{
    /**
     * Mostra o formulário de cadastro de proprietário de arena.
     */
    public function create()
    {
        return view('auth.registerArenaOwners');
    }

    /**
     * Cria o usuário (tipo owner) e o proprietário de uma só vez.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'company_name' => ['required', 'string', 'max:150'],
            'tax_id' => ['required', 'string', 'max:20', 'unique:owners,tax_id'],
        ]);

        // Transação: ou cria usuário E proprietário, ou não cria nada.
        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password_hash' => Hash::make($validated['password']),
                'type' => 'owner',
            ]);

            Owner::create([
                'user_id' => $user->id,
                'company_name' => $validated['company_name'],
                'tax_id' => $validated['tax_id'],
            ]);

            return $user;
        });

        // Já loga o usuário recém-criado e leva ao painel.
        Auth::login($user);

        return redirect()->route('owners.dashboard');
    }
}
