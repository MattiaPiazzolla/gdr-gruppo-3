@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Modifica Tipo</h1>

        <form action="{{ route('types.update', $type->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" value="{{ $type->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea class="form-control" name="description" rows="3" required>{{ $type->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Immagine</label>
                <input type="file" class="form-control" name="image">
                @if ($type->image)
                    <p>Immagine attuale:</p>
                    <img src="{{ asset($type->image) }}" alt="{{ $type->name }}" width="150">
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success mt-3">Aggiorna Type</button>
                <a href="{{ route('types.index') }}" class="btn btn-danger mt-3">Annulla</a>
            </div>
        </form>
    </div>
@endsection
