@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Personaggi</h1>

        <a href="{{ route('characters.create') }}" class="btn btn-primary">Aggiungi Personaggio</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
        </table>
    </div>
@endsection
