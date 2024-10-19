@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Aggiungi un nuovo Item</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <div class="form-group">
                <label for="category">Categoria</label>
                <input type="text" name="category" class="form-control" id="category" required>
            </div>

            <div class="form-group">
                <label for="type">Tipo</label>
                <input type="text" name="type" class="form-control" id="type" required>
            </div>

            <div class="form-group">
                <label for="weight">Peso</label>
                <input type="text" name="weight" class="form-control" id="weight" required>
            </div>

            <div class="form-group">
                <label for="cost">Costo</label>
                <input type="text" name="cost" class="form-control" id="cost" required>
            </div>

            <div class="form-group">
                <label for="dice">Dadi</label>
                <input type="text" name="dice" class="form-control" id="dice" required>
            </div>

            <div class="form-group">
                <label for="image">Carica un'immagine</label>
                <input type="file" name="image" class="form-control" accept=".png, .webp">
                <small class="form-text text-muted">Carica un'immagine in formato .png o .webp</small>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success mt-2">Aggiungi Item</button>
                <a href="{{ route('items.index') }}" class="btn btn-danger mt-3">Annulla</a>
            </div>
        </form>
    </div>
@endsection
