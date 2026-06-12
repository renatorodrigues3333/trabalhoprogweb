@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-container container-fluid py-4">

    <!-- Cabeçalho -->
    <div class="mb-5">
        <h1 class="dashboard-title">
            Bem-vindo, {{ Auth::user()->name }}!
        </h1>

        <p class="dashboard-subtitle">
            Gerencie seus agendamentos e reserve novas quadras
        </p>
    </div>

    <!-- Cards Resumo -->
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="dashboard-card">

                <div>
                    <h5>Próximos</h5>
                    <h2>0</h2>
                </div>

                <i class="bi bi-calendar-check dashboard-icon text-secondary"></i>

            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">

                <div>
                    <h5>Pendentes</h5>
                    <h2>1</h2>
                </div>

                <i class="bi bi-three-dots dashboard-icon text-warning"></i>

            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">

                <div>
                    <h5>Confirmados</h5>
                    <h2>1</h2>
                </div>

                <i class="bi bi-check-circle dashboard-icon text-success"></i>

            </div>
        </div>

    </div>

    <!-- Conteúdo Principal -->
    <div class="row g-4">

        <!-- Agendamentos -->
        <div class="col-lg-8">

            <div class="dashboard-box">

                <h2 class="section-title">
                    Próximos Agendamentos
                </h2>

                <p class="text-muted">
                    Nenhum agendamento próximo
                </p>

                <button class="btn dashboard-btn-outline w-100 mt-4">
                    VER TODOS OS AGENDAMENTOS
                </button>

            </div>

        </div>

        <!-- Lateral -->
        <div class="col-lg-4">

            <!-- Ações rápidas -->
            <div class="dashboard-box mb-4">

                <h2 class="section-title">
                    Ações Rápidas
                </h2>

                <div class="d-grid gap-3 mt-4">

                    <a href="#" class="btn dashboard-btn-primary">
                        <i class="bi bi-calendar-plus me-2"></i>
                        NOVA RESERVA
                    </a>

                    <a href="#" class="btn dashboard-btn-outline">
                        <i class="bi bi-clock-history me-2"></i>
                        HISTÓRICO
                    </a>

                    <a href="{{ route('profile.show') }}"
                       class="btn dashboard-btn-outline">
                        <i class="bi bi-person-fill me-2"></i>
                        MEU PERFIL
                    </a>

                </div>

            </div>

            @if(auth()->user()->type === 'client')

                <!-- Cliente -->
                <div class="arena-owner-card">

                    <h3>
                        <i class="bi bi-trophy-fill me-2"></i>
                        Tem uma Arena?
                    </h3>

                    <p>
                        Cadastre sua arena e gerencie quadras,
                        agendamentos e funcionários como proprietário.
                    </p>

                    <a href="{{ route('owners.create') }}"
                       class="btn btn-warning w-100">

                        <i class="bi bi-plus-circle me-2"></i>
                        Become an Owner

                    </a>

                </div>
            @endif
            @if (auth()->user()->type === 'owner')
                <!-- Proprietário -->
                <div class="arena-owner-card">

                    <h3>
                        <i class="bi bi-building-fill me-2"></i>
                        Área do Proprietário
                    </h3>

                    <p>
                        Você possui arenas cadastradas.
                        Gerencie quadras, reservas e funcionários.
                    </p>

                    <a href="{{ route('arenas.index') }}"
                       class="btn btn-warning w-100">

                        <i class="bi bi-gear-fill me-2"></i>
                        ACESSAR MINHAS ARENAS

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection