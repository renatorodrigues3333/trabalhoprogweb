@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
          <div class="dashboard-container container-fluid py-4">

        <!-- Título -->
        <div class="mb-5">
            <h1 class="dashboard-title">
                Bem-vindo, {{ Auth::user()->name }}!
            </h1>

            <p class="dashboard-subtitle">
                Gerencie seus agendamentos e reserve novas quadras
            </p>
        </div>

        <!-- Cards -->
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

        <!-- Conteúdo -->
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

            <!-- Ações -->
            <div class="col-lg-4">

                <div class="dashboard-box">

                    <h2 class="section-title">
                        Ações Rápidas
                    </h2>

                    <div class="d-grid gap-3 mt-4">

                        <button class="btn dashboard-btn-primary">
                            <i class="bi bi-search me-2"></i>
                            NOVA RESERVA
                        </button>

                        <button class="btn dashboard-btn-outline">
                            <i class="bi bi-clock-history me-2"></i>
                            HISTÓRICO
                        </button>
                        <a href="{{ route('profile.show') }}" class="btn dashboard-btn-outline">
                            <i class="bi bi-clock-history me-2"></i>
                            MEU PERFIL
                        </a>
                        <a href="{{ route('arenas.create') }}" class="btn dashboard-btn-outline">
                            <i class="bi bi-plus-circle me-2"></i>
                            NOVA ARENA
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection