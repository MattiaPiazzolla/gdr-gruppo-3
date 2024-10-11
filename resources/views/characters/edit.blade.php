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

            <div class="form-group mt-3">
                <label for="type_id">Tipo</label>
                <select class="form-control" name="type_id" required>
                    <option value="">Seleziona un tipo</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $character->type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label>Seleziona un Oggetto:</label>
                <div class="row">
                    @foreach ($items as $item)
                        <div class="col-2 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="item_ids[]"
                                    value="{{ $item->id }}" id="item_{{ $item->id }}"
                                    {{ in_array($item->id, $character->items->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label class="form-check-label" for="item_{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success mt-3">Aggiorna Personaggio</button>
                <a href="{{ route('characters.index') }}" class="btn btn-danger mt-3">Annulla</a>
            </div>
        </form>
    </div>
@endsection
