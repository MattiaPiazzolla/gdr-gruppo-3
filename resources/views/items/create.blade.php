@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Aggiungi un nuovo Item</h1>

        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" required>
            </div>

            <div class="form-group">
                <label for="category">Categoria</label>
                <input type="text" name="category" class="form-control" id="category" required>
            </div>

            <div class="form-group">
                <label for="type">Tipo</label>
                <input type="text" name="type" class="form-control" id="type" required>
            </div>

            <div class="form-group">
                <label for="weight">Peso</label>
                <input type="text" name="weight" class="form-control" id="weight" required>
            </div>

            <div class="form-group">
                <label for="cost">Costo</label>
                <input type="text" name="cost" class="form-control" id="cost" required>
            </div>

            <div class="form-group">
                <label for="dice">Dadi</label>
                <input type="text" name="dice" class="form-control" id="dice" required>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Aggiungi Item</button>
        </form>
    </div>
@endsection
