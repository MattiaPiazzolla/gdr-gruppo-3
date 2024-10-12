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
                <label>Seleziona Oggetti e Quantità:</label>
                <div class="row">
                    @foreach ($items as $item)
                        @php

                            $existingItem = $character->items->where('id', $item->id)->first();
                            $quantity = $existingItem ? $existingItem->pivot->quantity : 1;
                        @endphp

                        <div class="col-4 mb-3">
                            <div class="d-flex align-items-center">
                                <input class="form-check-input me-2" type="checkbox" name="items[{{ $item->id }}][id]"
                                    value="{{ $item->id }}" id="item_{{ $item->id }}"
                                    {{ $existingItem ? 'checked' : '' }}>

                                <label class="form-check-label me-3" for="item_{{ $item->id }}">
                                    {{ $item->name }}
                                </label>

                                <input type="number" class="form-control" name="items[{{ $item->id }}][quantity]"
                                    value="{{ $quantity }}" min="1" style="width: 70px;">
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
