@extends('layouts.main')
@section('title', 'ArenaPlay')
@section('content')
      <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <img src="{{ asset('img/img1.jpg') }}" 

                 class="d-block w-100"

                 style="height: 500px; object-fit: cover;">

            <div class="carousel-caption d-none d-md-block">

                <h1>Bem-vindo à ArenaPlay</h1>

                <p>Os melhores jogos e campeonatos.</p>

            </div>
    <div class="carousel-item">
      <img src="{{ asset('img/img2.jpg') }}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/img3.jpg') }}" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container py-5">

    <h2 class="fw-bold mb-4 text-center">
        Arenas Disponíveis
    </h2>

    <div class="row">
        @forelse($arenas as $arena)

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <h4>{{ $arena->name }}</h4>

                        <p class="text-muted">
                            {{ $arena->address_rua }}, {{ $arena->address_numero }}
                            - {{ $arena->address_bairro }}
                        </p>

                        <p>
                            {{ $arena->description }}
                        </p>

                    </div>

                    <div class="card-footer bg-white">

                        <a href="{{ route('arenas.show', $arena->id) }}"
                        class="btn btn-primary w-100">
                            Ver Arena
                        </a>

                    </div>

                </div>
            </div>

        @empty

            <div class="col-12 text-center py-5">
                <h4>Nenhuma arena cadastrada ainda</h4>
            </div>

        @endforelse

    </div>

</div>
@endsection
