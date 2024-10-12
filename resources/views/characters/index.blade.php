@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="headerCharacter">
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


        <div id="gridView" class="row gy-5 gx-0 mt-0 justify-content-center">
            @foreach ($characters as $character)
                <div class="col-3 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('characters.show', $character->id) }}" class="text-decoration-none text-dark ">
                            <h5 class="card-title text-center py-4">{{ $character->name }}</h5>
                            <img class="card-img-top img-fluid char_img_index"
                                src="{{ asset($character->type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                                alt="{{ $character->name }}">
                        </a>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="card-text text-center">{{ $character->description }}</p>
                            <div class="buttons-card d-flex justify-content-around ">
                                <a href="{{ route('characters.edit', $character->id) }}"
                                    class="btn btn-outline-warning m-1"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn btn-outline-danger m-1 delete-character"
                                    data-character-id="{{ $character->id }}">
                                    <i class="bi bi-trash2-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

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
                                <a href="{{ route('characters.edit', $character->id) }}"
                                    class="btn btn-warning">Modifica</a>

                                <button type="button" class="btn btn-danger m-1 delete-character"
                                    data-character-id="{{ $character->id }}">
                                    Cancella
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('characters.partials.modal_character_delete');
@endsection
