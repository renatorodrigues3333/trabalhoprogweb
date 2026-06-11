<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        auth()->user()->arenas()->create([
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'telefone' => $request->telefone,
        ]);
        return redirect()->route('arenas.index')->with('success', 'Arena criada com sucesso!');
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
