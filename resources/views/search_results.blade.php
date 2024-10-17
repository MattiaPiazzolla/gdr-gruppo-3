@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="headerCharacter">
            <h1>Risultati di ricerca per: "{{ $query }}"</h1>
            <a href="{{ route('home') }}" class="btn btn-dark my-4">Torna alla home</a>
        </div>

        @if ($characters->isEmpty() && $items->isEmpty() && $types->isEmpty())
            <p>Nessun risultato trovato.</p>
        @else
            @if (!$characters->isEmpty())
                <h3>Personaggi</h3>
                <div class="row gy-5 gx-0 mt-3 justify-content-center">
                    @foreach ($characters as $character)
                        <div class="col-3 d-flex justify-content-center">
                            <div class="card d-flex flex-column justify-content-between" style="width: 18rem;">
                                <a href="{{ route('characters.show', $character->id) }}"
                                    class="text-decoration-none text-dark">
                                    <h3 class="card-title text-center py-4">{{ $character->name }}</h3>
                                    <img class="card-img-top img-fluid"
                                        src="{{ asset('img/character_images/' . $character->name . '.webp') }}"
                                        alt="{{ $character->name }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (!$items->isEmpty())
                <h3 class="mt-4">Oggetti</h3>
                <div class="row gy-5 gx-0 mt-3 justify-content-center">
                    @foreach ($items as $item)
                        <div class="col-3 d-flex justify-content-center">
                            <div class="card d-flex flex-column justify-content-between" style="width: 18rem;">
                                <a href="{{ route('items.show', $item->id) }}" class="text-decoration-none text-dark">
                                    <h3 class="card-title text-center py-4">{{ $item->name }}</h3>
                                    <img class="item_show_img" src="{{ asset('img/Items_icons/' . $item->name . '.png') }}"
                                        alt="{{ $item->name }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (!$types->isEmpty())
                <h3 class="mt-4">Tipi</h3>
                <div class="row gy-5 gx-0 mt-3 justify-content-center">
                    @foreach ($types as $type)
                        <div class="col-3 d-flex justify-content-center">
                            <div class="card d-flex flex-column justify-content-between" style="width: 18rem;">
                                <a href="{{ route('types.show', $type->id) }}" class="text-decoration-none text-dark">
                                    <h3 class="card-title text-center py-4">{{ $type->name }}</h3>
                                    <img class="card-img-top img-type img-fluid"
                                        src="{{ asset($type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                                        alt="{{ $type->name }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection
