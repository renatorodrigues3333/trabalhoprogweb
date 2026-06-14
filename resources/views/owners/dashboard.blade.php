@extends('layouts.main')

@section('title', 'Owner Dashboard')

@section('content')

<div class="container py-4">

    <div class="mb-4">
        <h1 class="fw-bold">
            Welcome, {{ auth()->user()->name }}!
        </h1>

        <p class="text-muted fs-4">
            Manage your arenas, courts, bookings and employees
        </p>
    </div>

    <!-- Cards -->
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-secondary">Arenas</h4>
                    <h1 class="fw-bold">{{ $arenasCount }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-secondary">Courts</h4>
                    <h1 class="fw-bold">{{ $courtsCount }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-secondary">Today's Bookings</h4>
                    <h1 class="fw-bold">0</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-secondary">Customers</h4>
                    <h1 class="fw-bold">3</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-secondary">Employees</h4>
                    <h1 class="fw-bold">2</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-secondary">Monthly Revenue</h4>
                    <h1 class="fw-bold text-success">
                        R$ 390,00
                    </h1>
                </div>
            </div>
        </div>

    </div>

    <!-- Actions + Bookings -->
    <div class="row">

        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h2 class="fw-bold mb-4">
                        Açoes Rápidas
                    </h2>

                    <div class="d-grid gap-3">

                        <a href="{{ route('arenas.create') }}"
                            class="btn btn-outline-dark btn-lg">
                            🏟 Nova Arena
                        </a>

                        <a href="#"
                            class="btn btn-outline-dark btn-lg">
                            ⚽ Nova Quadra
                        </a>

                        <a href="#"
                            class="btn btn-outline-dark btn-lg">
                            👤 Novo Funcionário
                        </a>

                        <a href="#"
                            class="btn btn-outline-dark btn-lg">
                            💰 Abrir Caixa
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h2 class="fw-bold mb-4">
                        Proximos Agendamentos
                    </h2>

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Court</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    No bookings found
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection