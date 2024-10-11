@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Aggiungi Personaggio</h1>

        <form action="{{ route('characters.store') }}" method="POST">
            @csrf
            <div class="form-group mt-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group mt-3">
                <label for="description">Descrizione</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="form-group mt-3">
                <label for="strength">Forza</label>
                <input type="number" class="form-control" name="strength" required>
            </div>
            <div class="form-group mt-3">
                <label for="defence">Difesa</label>
                <input type="number" class="form-control" name="defence" required>
            </div>
            <div class="form-group mt-3">
                <label for="speed">Velocità</label>
                <input type="number" class="form-control" name="speed" required>
            </div>
            <div class="form-group mt-3">
                <label for="intelligence">Intelligenza</label>
                <input type="number" class="form-control" name="intelligence" required>
            </div>
            <div class="form-group mt-3">
                <label for="life">Vita</label>
                <input type="number" class="form-control" name="life" required>
            </div>

            <div class="form-group mt-3">
                <label for="type_id">Tipo</label>
                <select class="form-control" name="type_id" required>
                    <option value="">Seleziona un tipo</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
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
                                    value="{{ $item->id }}" id="item_{{ $item->id }}">
                                <label class="form-check-label" for="item_{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success mt-2">Salva</button>
                <a href="{{ route('characters.index') }}" class="btn btn-danger mt-3">Annulla</a>
            </div>
        </form>
    </div>
@endsection
