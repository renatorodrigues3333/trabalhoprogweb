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
<div class="container mt-5">
  <h2 class="text-center">Arenas disponiveis</h2>
</div>
<div>
  <h1 class="text-center">Arena Sport Beach</h1>
</div>
<div>
  <h1 class="text-center">Arena do mauro</h1>
</div>
@endsection
