@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Modifica Personaggio</h1>

        <form action="{{ route('characters.update', $character->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" value="{{ $character->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descrizione</label>
                <input type="text" class="form-control" name="description" value="{{ $character->description }}"
                    required>
            </div>

            <div class="form-group">
                <label for="strength">Forza</label>
                <input type="number" class="form-control" name="strength" value="{{ $character->strength }}" required>
            </div>

            <div class="form-group">
                <label for="defence">Difesa</label>
                <input type="number" class="form-control" name="defence" value="{{ $character->defence }}" required>
            </div>

            <div class="form-group">
                <label for="speed">Velocità</label>
                <input type="number" class="form-control" name="speed" value="{{ $character->speed }}" required>
            </div>

            <div class="form-group">
                <label for="intelligence">Intelligenza</label>
                <input type="number" class="form-control" name="intelligence" value="{{ $character->intelligence }}"
                    required>
            </div>

            <div class="form-group">
                <label for="life">Vita</label>
                <input type="number" class="form-control" name="life" value="{{ $character->life }}" required>
            </div>

            <div class="form-group">
                <label for="type_id">ID Tipo</label>
                <input type="number" class="form-control" name="type_id" value="{{ $character->type_id }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Aggiorna Personaggio</button>
        </form>
    </div>
@endsection
