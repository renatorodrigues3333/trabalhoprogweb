
@foreach($arenas as $arena)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $arena->nome }}</h5>
            <p>{{ $arena->endereco }}</p>
            <p>{{ $arena->telefone }}</p>
        </div>
    </div>
@endforeach
