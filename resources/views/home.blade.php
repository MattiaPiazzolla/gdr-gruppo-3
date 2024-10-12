@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="headerCharacter text-center">
            <h1 class="my-3">GDR</h1>
            <h3>Benvenuto nella tua area di Gestion</h3>
        </div>
        <div class="d-flex flex-column justify-content-center align-content-center mt-5">
            <form action="{{ route('search') }}" method="GET" class="w-100 mb-5">
                <div class="d-flex flex-column align-items-center">
                    <h5>Cerca quello che ti serve</h5>
                    <input name="query" class="form-control me-2 w-50" type="search" placeholder="Cerca...">
                </div>
            </form>
            <h5 class="text-center">Azioni Rapide</h5>
            <div class="d-flex justify-content-center">
                <a href="{{ route('items.create') }}" class="btn btn-outline-success me-2">Aggiungi Oggetto</a>
                <a href="{{ route('characters.create') }}" class="btn btn-outline-success me-2">Aggiungi Personaggio</a>
                <a href="{{ route('types.create') }}" class="btn btn-outline-success">Aggiungi Tipo</a>
            </div>
        </div>

    </div>
@endsection
