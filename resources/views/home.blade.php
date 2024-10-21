@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="headerCharacter text-center">
            <h1 class="my-3">GDR</h1>
            <h3>Benvenuto nella tua area di gestione</h3>
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

        <!-- Sezione per gli ultimi 3 personaggi -->
        <div class="my-5">
            <h3 class="text-center">Ultimi Personaggi</h3>
            <div class="row">
                @foreach ($latestCharacters as $character)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <a href="{{ route('characters.show', $character->id) }}" class="text-decoration-none text-dark">
                                @if (file_exists(public_path('img/character_images/' . $character->name . '.webp')))
                                    <img src="{{ asset('img/character_images/' . $character->name . '.webp') }}"
                                        class="img-fluid" alt="{{ $character->name }}">
                                @elseif (file_exists(public_path('img/character_images/' . $character->name . '.png')))
                                    <img src="{{ asset('img/character_images/' . $character->name . '.png') }}"
                                        class="img-fluid" alt="{{ $character->name }}">
                                @else
                                    <img src="{{ asset('img/character_images/placeholder.png') }}" class="img-fluid"
                                        alt="Immagine non disponibile">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $character->name }}</h5>
                                </div>
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sezione per gli ultimi 3 oggetti -->
        <div class="my-5">
            <h3 class="text-center">Ultimi Oggetti</h3>
            <div class="row">
                @foreach ($latestItems as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <a href="{{ route('items.show', $item->id) }}" class="text-decoration-none text-dark">
                                @if (file_exists(public_path('img/Items_icons/' . $item->name . '.webp')))
                                    <img src="{{ asset('img/Items_icons/' . $item->name . '.webp') }}"
                                        class="img-fluid w-100" alt="{{ $item->name }}">
                                @elseif (file_exists(public_path('img/Items_icons/' . $item->name . '.png')))
                                    <img src="{{ asset('img/Items_icons/' . $item->name . '.png') }}"
                                        class="img-fluid w-100" alt="{{ $item->name }}">
                                @else
                                    <img src="{{ asset('img/Items_icons/placeholder.png') }}" class="img-fluid w-100"
                                        alt="Immagine non disponibile">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $item->name }}</h5>
                                </div>
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sezione per gli ultimi 3 tipi -->
        <div class="my-5">
            <h3 class="text-center">Ultimi Tipi</h3>
            <div class="row">
                @foreach ($latestTypes as $type)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <a href="{{ route('types.show', $type->id) }}" class="text-decoration-none text-dark">
                                <img class="card-img-top img-type img-fluid"
                                    src="{{ asset($type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                                    alt="{{ $type->name }}">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $type->name }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
