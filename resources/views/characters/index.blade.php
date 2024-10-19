@extends('layouts.app')

@section('content')
    <div class="container my-5">


        <div class="headerCharacter mb-2">
            <h1>Personaggi</h1>
            <nav class="navbar navbar-light">
            </nav>
            <div class="d-flex mt-3 justify-content-between">
                <div>
                    <button id="showGrid" class="btn me-2 btn-outline-dark active">
                        <i class="bi bi-card-image"></i>
                    </button>
                    <button id="showTable" class="btn btn-outline-dark me-2">
                        <i class="bi bi-table"></i>
                    </button>
                    <a href="{{ route('characters.create') }}" class="btn btn-outline-success me-2">Aggiungi Personaggio</a>
                </div>
                <form action="{{ route('characters.index') }}" method="GET" class="w-50">
                    <div class="d-flex">
                        <input name="search" class="form-control me-2 w-100 border-2" type="search" placeholder="Cerca..."
                            aria-label="Search" value="{{ request('search') }}">
                        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Cerca</button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Grid View -->
        <div id="gridView" class="row gy-5 gx-0 mt-0 justify-content-center">
            @foreach ($characters as $character)
                <div class="col-3 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('characters.show', $character->id) }}" class="text-decoration-none text-dark">
                            <h5 class="card-title text-center py-4">{{ $character->name }}</h5>
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
                        </a>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="card-text text-center">{{ $character->description }}</p>

                            <!-- Differenzia i personaggi eliminati -->
                            <div class="buttons-card d-flex justify-content-around ">
                                @if ($character->trashed())
                                    <form action="{{ route('characters.restore', $character->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success ">
                                            Ripristina
                                        </button>
                                    </form>
                                @else
                                    <div>
                                        <a href="{{ route('characters.edit', $character->id) }}"
                                            class="btn btn-outline-warning ">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('characters.softDelete', $character->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger ">
                                            <i class="bi bi-trash2-fill"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <h2>Personaggi Eliminati</h2>
            <div class="row gy-5 gx-0 mt-0 justify-content-center">
                @foreach ($deletedCharacters as $character)
                    <div class="col-3 d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <a href="{{ route('characters.show', $character->id) }}"
                                class="text-decoration-none text-dark">
                                <h5 class="card-title text-center py-4">{{ $character->name }}</h5>
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
                            </a>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <p class="card-text text-center">{{ $character->description }}</p>
                                <div class="buttons-card d-flex justify-content-around">
                                    <form action="{{ route('characters.restore', $character->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success">
                                            Ripristina
                                        </button>
                                    </form>
                                    <!-- Pulsante per aprire il modale di eliminazione -->
                                    <button type="button" class="btn btn-outline-danger delete-character"
                                        data-url="{{ route('characters.forceDelete', $character->id) }}">
                                        Elimina
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Table View -->
        <div id="tableView" class="table-responsive py-5" style="display:none;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($characters as $character)
                        <tr>
                            <td>{{ $character->name }}</td>
                            <td>{{ $character->description }}</td>
                            <td>
                                <a href="{{ route('characters.show', $character->id) }}"
                                    class="btn btn-primary">Visualizza</a>
                                @if ($character->trashed())
                                    <form action="{{ route('characters.restore', $character->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Ripristina</button>
                                    </form>
                                @else
                                    <a href="{{ route('characters.edit', $character->id) }}"
                                        class="btn btn-warning">Modifica</a>
                                    <button type="button" class="btn btn-outline-danger delete-character"
                                        data-character-id="{{ $character->id }}"
                                        data-url="{{ route('characters.forceDelete', $character->id) }}">
                                        Elimina
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('characters.partials.modal_character_delete')
@endsection
