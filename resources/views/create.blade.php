@extends('welcome')

<form action="{{ route('characters.store') }}" method="POST">
    @csrf
    <label for="name">Nome:</label>
    <input type="text" name="name" required>

    <label for="slug">Slug:</label>
    <input type="text" name="slug" required>

    <label for="category">Categoria:</label>
    <input type="text" name="category" required>

    <label for="type">Tipo:</label>
    <input type="text" name="type" required>

    <label for="weight">Peso:</label>
    <input type="number" name="weight" required>

    <button type="submit">Aggiungi Personaggio</button>
</form>
