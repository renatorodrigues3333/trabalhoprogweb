@extends('layouts.main')

@section('content')

<div class="container py-5">

    <div class="card shadow mx-auto" style="max-width: 900px;">
        <div class="card-body p-4">

            <h2 class="mb-4">Nova Arena</h2>

            <form action="{{ route('arenas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <input
                        type="text"
                        name="nome"
                        class="form-control form-control-lg"
                        placeholder="Nome da Arena"
                        required>
                </div>

                <div class="mb-3">
                    <textarea
                        name="descricao"
                        class="form-control"
                        rows="4"
                        placeholder="Descrição"></textarea>
                </div>

                <div class="mb-3">
                    <input
                        type="text"
                        name="endereco"
                        class="form-control"
                        placeholder="Endereço Completo"
                        required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input
                            type="text"
                            name="telefone"
                            class="form-control"
                            placeholder="Telefone">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input
                            type="email"
                            name="email_contato"
                            class="form-control"
                            placeholder="Email de Contato">
                    </div>
                </div>

                <h5 class="mt-4 mb-3">
                    Formas de Pagamento Aceitas
                </h5>

                <div class="form-check mb-2">
                    <input class="form-check-input"
                           type="checkbox"
                           name="pagamentos[]"
                           value="pix">
                    <label class="form-check-label">
                        PIX
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input"
                           type="checkbox"
                           name="pagamentos[]"
                           value="credito">
                    <label class="form-check-label">
                        Cartão de Crédito
                    </label>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="pagamentos[]"
                           value="debito">
                    <label class="form-check-label">
                        Cartão de Débito
                    </label>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('arenas.index') }}"
                       class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        Salvar
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection