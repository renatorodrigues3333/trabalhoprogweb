<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arena;
use App\Models\Owner;
class ArenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arenas = auth()->user()->arenas;
        return view('arenas.index', compact('arenas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('arenas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $owner = Owner::where('user_id', auth()->id())->first();

        if (! $owner) {
            abort(403, 'Apenas proprietários podem cadastrar arenas.');
        }

        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:120'],
            'endereco' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'email_contato' => ['nullable', 'email', 'max:150'],
        ]);

        Arena::create([
            'owner_id' => $owner->id,
            'name' => $validated['nome'],
            'address' => $validated['endereco'],
            'description' => $validated['descricao'] ?? null,
            'phone' => $validated['telefone'] ?? null,
            'contact_email' => $validated['email_contato'] ?? null,
        ]);

        return redirect()->route('owners.dashboard');
    }
    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
