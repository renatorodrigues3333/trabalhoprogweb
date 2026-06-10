<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/script.js"></script>
    
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container-fluid px-4">
    
                <!-- Logo -->
                <a class="navbar-brand logo" href="/">
                    ArenaPlay
                </a>
    
                <!-- Botão Mobile -->
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <!-- Menu -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    
                    <ul class="navbar-nav align-items-center gap-4">
    
                        <li class="nav-item">
                            <a class="nav-link active" href="/">
                                <i class="bi bi-house-fill"></i>
                                INÍCIO
                            </a>
                        </li>
    
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/login">
                                    ENTRAR
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-register" href="/register">
                                    CADASTRAR
                                </a>
                            </li>
                        @endguest
    
                        @auth
                            @php
                                $route = '/dashboard';

                                if (auth()->user()->role == 'admin') {
                                    $route = '/admin';
                                }
                                if (auth()->user()->role == 'cliente') {
                                    $route = '/dashboard';
                                }
                                if (auth()->user()->role == 'funcionario') {
                                    $route = '/funcionario';
                                }
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}">
                                    MINHA ÁREA
                                </a>
                            </li>

                            <li class="nav-item">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="btn btn-danger">
                                        SAIR
                                    </button>
                                </form>
                            </li>
                        @endauth
    
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row">
                @if(session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                @endif
                @yield('content')
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    </body>
    
    </html>