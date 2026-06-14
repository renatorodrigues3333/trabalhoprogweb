<?php

namespace App\Http\Controllers;

use App\Models\Arena;
use App\Models\Court;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
            'company_name' => ['required', 'string', 'max:150', 'unique:owners,company_name'],
            'tax_id' => ['required', 'string', 'max:20', 'unique:owners,tax_id'],
            'name_arena' => ['required', 'string', 'max:120', 'unique:arenas,name'],
            'description' => ['max:300'],
            'address_rua' => ['required', 'string', 'max:120'],
            'address_bairro' => ['required', 'string', 'max:120'],
            'address_numero' => ['required', 'string', 'max:15'],
            'phone' => ['required', 'string', 'max:20'],
            'email_arena' => ['required', 'email', 'max:150', 'unique:arenas,contact_email'],
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
            'company_name.unique' => 'Já existe uma empresa cadastrada com esse nome.',
            'name_arena.unique' => 'Já existe uma arena com esse nome.',
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

        $horarios = $request->input('horarios', []);
        $pagamentos = $request->input('pagamentos', []);
        $quadras = $request->input('quadras', []);

        // Transação: ou cria usuário E proprietário, ou não cria nada.
        $user = DB::transaction(function () use ($validated, $horarios, $pagamentos, $quadras) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password_hash' => Hash::make($validated['password']),
                'type' => 'owner',
            ]);

            $owner = Owner::create([
                'user_id' => $user->id,
                'company_name' => $validated['company_name'],
                'tax_id' => $validated['tax_id'],
            ]);

            $arena = Arena::create([
                'owner_id' => $owner->id,
                'name' => $validated['name_arena'],
                'description' => $validated['description'],
                'address_rua' => $validated['address_rua'],
                'address_bairro' => $validated['address_bairro'],
                'address_numero' => $validated['address_numero'],
                'phone' => $validated['phone'],
                'contact_email' => $validated['email_arena'],
            ]);

            ArenaController::salvarHorarios($arena, $horarios);

            ArenaController::salvarQuadras($arena, $quadras);

            $arena->paymentMethods()->sync($pagamentos);

            return $user;
        });

        // Já loga o usuário recém-criado e leva ao painel.
        Auth::login($user);

        return redirect()->route('owners.dashboard');
    }
}
