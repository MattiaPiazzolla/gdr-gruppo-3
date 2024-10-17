@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header bg-black">
                <div class="row">
                    <div class="col-6 py-2 px-5 d-flex align-items-center justify-content-start" style="height: 75px;">
                        <a href="{{ route('characters.index') }}">
                            <i class="btn btn-outline-light bi bi-caret-left-fill me-3 p-0 px-1 fw-bolder"></i>
                        </a>
                        <h2 class="card-title m-0 text-light">{{ $character->name }}</h2>
                    </div>
                    <div class="col-6 py-1 px-5 d-flex align-items-center justify-content-end" style="height: 75px;">
                        <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-outline-warning m-1"><i
                                class="bi bi-pencil-square"></i></a>
                        <button type="button" class="btn btn-outline-danger m-1 delete-character"
                            data-character-id="{{ $character->id }}">
                            <i class="bi bi-trash2-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-5">
                        <h5 class="mt-5 mb-3">Descrizione:</h5>
                        <p class="card-text">{{ $character->description }}</p>
                        <div class="row">
                            <h5 class="mt-5 mb-3">Statistiche</h5>
                            <div class="col-6">

                                <p class="fw-bold">Tipo</p>
                                <p class="fw-bold">Forza</p>
                                <p class="fw-bold">Difesa</p>
                                <p class="fw-bold">Velocità</p>
                                <p class="fw-bold">Intelligenza</p>
                                <p class="fw-bold">Punti Vita</p>
                            </div>
                            <div class="col-6">
                                <p>{{ $character->type->name ?? 'Non definito' }}</p>
                                <p>{{ $character->strength }}</p>
                                <p>{{ $character->defence }}</p>
                                <p>{{ $character->speed }}</p>
                                <p>{{ $character->intelligence }}</p>
                                <p>{{ $character->life }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        @if (file_exists(public_path('img/character_images/' . $character->name . '.webp')))
                            <img src="{{ asset('img/character_images/' . $character->name . '.webp') }}" class="img-fluid"
                                alt="{{ $character->name }}">
                        @elseif (file_exists(public_path('img/character_images/' . $character->name . '.png')))
                            <img src="{{ asset('img/character_images/' . $character->name . '.png') }}" class="img-fluid"
                                alt="{{ $character->name }}">
                        @else
                            <img src="{{ asset('img/character_images/placeholder.png') }}" class="img-fluid"
                                alt="Immagine non disponibile">
                        @endif
                    </div>
                    <div class="col-12">
                        <h3>Inventario</h3>
                        <ul class="list-unstyled">
                            @forelse ($character->items as $item)
                                <li>{{ $item->name }} - X{{ $item->pivot->quantity }}</li>
                            @empty
                                <li>Nessun Oggetto.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('characters.partials.modal_character_delete');
@endsection
