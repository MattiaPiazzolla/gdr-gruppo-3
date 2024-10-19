@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Modifica Item</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $item->name) }}" required>
            </div>

            <div class="form-group">
                <label for="category">Categoria</label>
                <input type="text" class="form-control" name="category" value="{{ old('category', $item->category) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="type">Tipo</label>
                <input type="text" class="form-control" name="type" value="{{ old('type', $item->type) }}" required>
            </div>

            <div class="form-group">
                <label for="weight">Peso</label>
                <input type="number" class="form-control" name="weight" value="{{ old('weight', $item->weight) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="cost">Costo</label>
                <input type="number" class="form-control" name="cost" value="{{ old('cost', $item->cost) }}" required>
            </div>

            <div class="form-group">
                <label for="dice">Dadi</label>
                <input type="text" class="form-control" name="dice" value="{{ old('dice', $item->dice) }}" required>
            </div>

            <!-- Upload Immagine -->
            <div class="form-group">
                <label for="image">Carica una nuova immagine</label>
                <input type="file" name="image" class="form-control" accept=".png, .webp">
                <small class="form-text text-muted">Carica un'immagine in formato .png o .webp</small>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mostra l'immagine attuale -->
            <div class="form-group mt-3">
                @php
                    // Percorso immagine corrente
                    $imagePath = 'img/Items_icons/' . $item->name . '.png';
                @endphp

                @if (file_exists(public_path($imagePath)))
                    <p>Immagine attuale:</p>
                    <img src="{{ asset($imagePath) }}" alt="{{ $item->name }}" width="200">
                @else
                    <p>Nessuna immagine disponibile</p>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success mt-3">Aggiorna Oggetto</button>
                <a href="{{ route('items.index') }}" class="btn btn-danger mt-3">Annulla</a>
            </div>
        </form>
    </div>
@endsection
