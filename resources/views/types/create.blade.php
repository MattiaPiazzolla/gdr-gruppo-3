@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1>Aggiungi un Nuovo Tipo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('types.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">URL Immagine</label>
                <input type="text" name="image" class="form-control" value="{{ old('image') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success mt-3">Aggiungi Nuovo Tipo</button>
                <a href="{{ route('types.index') }}" class="btn btn-danger mt-3">Annulla</a>
            </div>
        </form>
    </div>
@endsection
