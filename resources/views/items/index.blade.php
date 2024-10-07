@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Items</h1>
        <a href="{{ route('items.create') }}" class="btn btn-primary">Aggiungi Item</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Weight</th>
                    <th>Cost</th>
                    <th>Dice</th>
                    <th>Azione</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->weight }}</td>
                        <td>{{ $item->cost }}</td>
                        <td>{{ $item->dice }}</td>
                        <td>
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-info">Visualizza</a>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Modifica</a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
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
