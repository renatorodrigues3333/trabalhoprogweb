<?php

namespace App\Http\Controllers;

use App\Models\Quadras;
use Illuminate\Http\Request;

class QuadraController extends Controller
{
    //CLUD

    public function index()
    {
        $quadras = Quadra::with('arena')->get();
        return view('quadras.index', compact('quadras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $arenas = auth()->user()->arenas;
        return view('quadras.create', compact('arenas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Quadras::create([
            'arena_id' => $request->arena_id,
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'disponibilidade' => $request->disponibilidade,
        ]);
        return redirect()->route('quadras.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
