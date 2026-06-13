<?php

namespace App\Http\Controllers;

use App\Models\Arena;
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
            'name_arena' => ['required', 'string', 'max:120'],
            'description' => ['max:300'],
            'address_rua' => ['required', 'string', 'max:120'],
            'address_bairro' => ['required', 'string', 'max:120'],
            'address_numero' => ['required', 'string', 'max:15'],
            'phone' => ['required', 'string', 'max:20'],
            'email_arena' => ['required', 'email', 'max:150', 'unique:arenas,contact_email']

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

            Arena::create([
                'owner_id' => $user->id,
                'name' => $validated['name_arena'],
                'description' => $validated['description'],
                'address_rua' => $validated['address_rua'],
                'address_bairro' => $validated['address_bairro'],
                'address_numero' => $validated['address_numero'],
                'phone' => $validated['phone'],
                'contact_email' => $validated['email_arena'],    
            ]);

            return $user;
        });

        // Já loga o usuário recém-criado e leva ao painel.
        Auth::login($user);

        return redirect()->route('owners.dashboard');
    }
}
