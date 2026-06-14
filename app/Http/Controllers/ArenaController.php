<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Arena;
use App\Models\Court;
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
            'nome' => ['required', 'string', 'max:120', 'unique:arenas,name'],
            'rua' => ['required', 'string', 'max:120'],
            'bairro' => ['required', 'string', 'max:100'],
            'numero' => ['required', 'string', 'max:15'],
            'descricao' => ['nullable', 'string'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'email_contato' => ['nullable', 'email', 'max:150'],
            'horarios' => ['required', 'array', function ($attribute, $value, $fail) {
                $algumDia = collect($value)->contains(fn ($dia) => ! empty($dia['aberto']));
                if (! $algumDia) {
                    $fail('Marque ao menos um dia de funcionamento.');
                }
            }],
            'horarios.*.aberto' => ['nullable', 'boolean'],
            'horarios.*.p1_abre' => ['required_with:horarios.*.aberto', 'date_format:H:i'],
            'horarios.*.p1_fecha' => ['required_with:horarios.*.aberto', 'date_format:H:i'],
            'horarios.*.p2_abre' => ['nullable', 'date_format:H:i'],
            'horarios.*.p2_fecha' => ['nullable', 'date_format:H:i'],
            'pagamentos' => ['required', 'array', 'min:1'],
            'pagamentos.*' => ['integer', 'exists:payment_methods,id'],
            'quadras' => ['required', 'array', 'min:1'],
            'quadras.*.nome' => ['required', 'string', 'max:80'],
            'quadras.*.descricao' => ['nullable', 'string'],
            'quadras.*.valor_hora' => ['required', 'numeric', 'min:0'],
            'quadras.*.ativa' => ['nullable', 'boolean'],
            'quadras.*.esportes' => ['required', 'array', 'min:1'],
            'quadras.*.esportes.*' => [Rule::in(array_keys(Court::SPORTS))],
        ], [
            'nome.unique' => 'Já existe uma arena com esse nome.',
            'horarios.required' => 'Marque ao menos um dia de funcionamento.',
            'horarios.*.p1_abre.required_with' => 'Informe o horário de abertura do dia marcado.',
            'horarios.*.p1_fecha.required_with' => 'Informe o horário de fechamento do dia marcado.',
            'pagamentos.required' => 'Selecione ao menos uma forma de pagamento.',
            'pagamentos.min' => 'Selecione ao menos uma forma de pagamento.',
            'quadras.required' => 'Cadastre ao menos uma quadra.',
            'quadras.min' => 'Cadastre ao menos uma quadra.',
            'quadras.*.nome.required' => 'Informe o nome da quadra.',
            'quadras.*.valor_hora.required' => 'Informe o valor por hora da quadra.',
            'quadras.*.esportes.required' => 'Selecione ao menos um esporte por quadra.',
            'quadras.*.esportes.min' => 'Selecione ao menos um esporte por quadra.',
        ]);

        $arena = Arena::create([
            'owner_id' => $owner->id,
            'name' => $validated['nome'],
            'address_rua' => $validated['rua'],
            'address_bairro' => $validated['bairro'],
            'address_numero' => $validated['numero'],
            'description' => $validated['descricao'] ?? null,
            'phone' => $validated['telefone'] ?? null,
            'contact_email' => $validated['email_contato'] ?? null,
        ]);

        $this->salvarHorarios($arena, $request->input('horarios', []));

        self::salvarQuadras($arena, $request->input('quadras', []));

        $arena->paymentMethods()->sync($request->input('pagamentos', []));

        return redirect()->route('owners.dashboard');
    }
    
    public function show($id)
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

    /**
     * Salva os horários de funcionamento de uma arena.
     *
     * Cada dia pode ter até 2 períodos (ex.: manhã e tarde, com pausa
     * para o almoço). Cada período preenchido vira uma linha em
     * arena_business_hours. Dias não marcados ficam sem registros (fechado).
     */
    public static function salvarHorarios(Arena $arena, array $horarios): void
    {
        for ($dia = 0; $dia <= 6; $dia++) {
            $info = $horarios[$dia] ?? [];

            if (empty($info['aberto'])) {
                continue;
            }

            $periodos = [
                ['abre' => $info['p1_abre'] ?? null, 'fecha' => $info['p1_fecha'] ?? null],
                ['abre' => $info['p2_abre'] ?? null, 'fecha' => $info['p2_fecha'] ?? null],
            ];

            foreach ($periodos as $periodo) {
                if (empty($periodo['abre']) || empty($periodo['fecha'])) {
                    continue;
                }

                $arena->businessHours()->create([
                    'day_of_week' => $dia,
                    'opens_at' => $periodo['abre'],
                    'closes_at' => $periodo['fecha'],
                ]);
            }
        }
    }

    /**
     * Salva as quadras de uma arena (com seus esportes).
     *
     * Cada item de $quadras vira uma linha em courts, e cada esporte marcado
     * vira uma linha em court_sports. Uma arena precisa de ao menos uma quadra
     * (garantido pela validação no store).
     */
    public static function salvarQuadras(Arena $arena, array $quadras): void
    {
        foreach ($quadras as $dados) {
            $court = $arena->courts()->create([
                'name' => $dados['nome'],
                'hourly_rate' => $dados['valor_hora'],
                'active' => ! empty($dados['ativa']),
                'description' => $dados['descricao'] ?? null,
            ]);

            // array_unique evita duplicar o mesmo esporte (unique court_id+sport).
            foreach (array_unique($dados['esportes'] ?? []) as $sport) {
                $court->sports()->create(['sport' => $sport]);
            }
        }
    }
}
