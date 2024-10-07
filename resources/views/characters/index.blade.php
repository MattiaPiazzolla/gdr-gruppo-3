@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="headerCharacter">
            <h1>Personaggi</h1>
            <nav class="navbar navbar-light ">
                <form class="d-flex w-100 justify-content-between">
                    <div class="search_bar_cont d-flex">
                        <input class="form-control mr-sm-2 me-3" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </div>
                    <a href="{{ route('characters.create') }}" class="btn btn-primary">Aggiungi Personaggio</a>
                </form>
            </nav>
        </div>


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row gy-5 gx-0 mt-3 justify-content-center">
            @foreach ($characters as $character)
                <div class="col-3 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('characters.show', $character->id) }}" class="text-decoration-none text-dark ">
                            <h5 class="card-title text-center py-4">{{ $character->name }}</h5>
                            <img class="card-img-top" src="{{ asset('characters_img/barbarian.gif') }}"
                                alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <p class="card-text">{{ $character->description }}</p>
                            <div class="buttons-card d-flex justify-content-around ">
                                <a href="{{ route('characters.edit', $character->id) }}"
                                    class="btn btn-warning">Modifica</a>
                                <form action="{{ route('characters.destroy', $character->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <table class="table">
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
                            <a href="{{ route('characters.show', $character->id) }}" class="btn btn-info">Visualizza</a>
                            <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-warning">Modifica</a>

                            <form action="{{ route('characters.destroy', $character->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
    </div>
@endsection
