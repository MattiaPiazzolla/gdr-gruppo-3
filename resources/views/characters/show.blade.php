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
                    <div class="col-4">
                        <h5 class="mt-5 mb-3 fw-bold">Descrizione:</h5>
                        <p class="card-text">{{ $character->description }}</p>
                        <div class="row">
                            <h5 class="mt-5 mb-3 fw-bold">Statistiche:</h5>
                            <div class="col-4">

                                <p class="fw-bold">Forza</p>
                                <p class="fw-bold">Difesa</p>
                                <p class="fw-bold">Velocità</p>
                                <p class="fw-bold">Intelligenza</p>
                                <p class="fw-bold">Punti Vita</p>
                                <p class="fw-bold">Tipo</p>
                            </div>
                            <div class="col-8">
                                <p>{{ $character->strength }}</p>
                                <p>{{ $character->defence }}</p>
                                <p>{{ $character->speed }}</p>
                                <p>{{ $character->intelligence }}</p>
                                <p>{{ $character->life }}</p>
                                <p>{{ $character->type->name }}</p>
                            </div>
                            <div class="col-12">
                                <img src="{{ asset($character->type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                                    alt="{{ $character->type->name }}" class="img-fluid w-50">
                            </div>
                        </div>
                    </div>
                    <div class="col-8 m-0 p-0">
                        @if (file_exists(public_path('img/character_images/' . $character->name . '.webp')))
                            <img src="{{ asset('img/character_images/' . $character->name . '.webp') }}"
                                class="img-fluid items-char-show" alt="{{ $character->name }}">
                        @elseif (file_exists(public_path('img/character_images/' . $character->name . '.png')))
                            <img src="{{ asset('img/character_images/' . $character->name . '.png') }}"
                                class="img-fluid items-char-show" alt="{{ $character->name }}">
                        @else
                            <img src="{{ asset('img/character_images/placeholder.png') }}"
                                class="img-fluid items-char-show" alt="Immagine non disponibile">
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                <h3>Inventario</h3>
                                <ul class="list-unstyled">
                                    @forelse ($character->items as $item)
                                        <li>{{ $item->name }} - X{{ $item->pivot->quantity }}</li>
                                    @empty
                                        <li>Nessun Oggetto.</li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="col-8 ">
                                <div class="row">
                                    @forelse ($character->items as $item)
                                        <div class="col-2 g-0">
                                            <div class="">
                                                <img class="item_show_img items-char-show"
                                                    src="{{ asset('img/Items_icons/' . $item->name . '.png') }}"
                                                    alt="{{ $item->name }}">
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('characters.partials.modal_character_delete');
@endsection
