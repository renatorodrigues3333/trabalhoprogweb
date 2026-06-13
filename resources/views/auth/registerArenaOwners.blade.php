<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register.arena.owners.store') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Nome') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="company_name" value="{{ __('Nome da Empresa') }}" />
                <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required />
            </div>

            <div class="mt-4">
                <x-label for="tax_id" value="{{ __('CPF / CNPJ') }}" />
                <x-input id="tax_id" class="block mt-1 w-full" type="text" name="tax_id" :value="old('tax_id')" required />
            </div>

            <div class="mt-4">
                <x-label for="name_arena" value="{{ __('Nome da Arena') }}" />
                <x-input id="name_arena" class="block mt-1 w-full" type="text" name="name_arena" :value="old('name_arena')" required />
            </div>

            <div class="mt-4">
                <x-label for="description" value="{{ __('Descrição') }}" />
                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')"/>
            </div>

            <div class="mt-4">
                <x-label for="address_rua" value="{{ __('Rua') }}" />
                <x-input id="address_rua" class="block mt-1 w-full" type="text" name="address_rua" :value="old('address_rua')" required />
            </div>

            <div class="mt-4">
                <x-label for="address_bairro" value="{{ __('Bairro') }}" />
                <x-input id="address_bairro" class="block mt-1 w-full" type="text" name="address_bairro" :value="old('address_bairro')" required />
            </div>

            <div class="mt-4">
                <x-label for="address_numero" value="{{ __('Número') }}" />
                <x-input id="address_numero" class="block mt-1 w-full" type="text" name="address_numero" :value="old('address_numero')" required />
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('Telafone de Contato da Arena') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <div class="mt-4">
                <x-label for="email_arena" value="{{ __('Email da sua Arena') }}" />
                <x-input id="email_arena" class="block mt-1 w-full" type="email" name="email_arena" :value="old('email_arena')" required autocomplete="username" />
            </div>

            <h5 class="mt-4 mb-3">
                    Infrome os Dias da Semana que Fucionara sua Arena
            </h5>

            <div class="form-check mb-2">
                <input class="form-check-input"
                    type="checkbox"
                    name="date"
                    value="segunda_feira">
                <label class="form-check-label">
                    Segunda_Feira
                </label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input"
                    type="checkbox"
                    name="date"
                    value="terça_feira">
                <label class="form-check-label">
                    Terça_Feira
                </label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input"
                    type="checkbox"
                    name="date"
                    value="quarta_feira">
                <label class="form-check-label">
                    Quarta_Feira
                </label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input"
                    type="checkbox"
                    name="date"
                    value="quinta_Feira">
                <label class="form-check-label">
                    Quinta_Feira
                </label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input"
                    type="checkbox"
                    name="date"
                    value="sexta_feira">
                <label class="form-check-label">
                    Sexta_Feira
                </label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input"
                    type="checkbox"
                    name="date"
                    value="sabado">
                <label class="form-check-label">
                    Sabado
                </label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input"
                    type="checkbox"
                    name="date"
                    value="Domingo">
                <label class="form-check-label">
                    Domingo
                </label>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Senha') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar Senha') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Casdastrar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>