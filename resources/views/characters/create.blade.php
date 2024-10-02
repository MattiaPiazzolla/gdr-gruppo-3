<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Character</title>
</head>

<body>
    <h1>Create a New Character</h1>

    <form action="{{ route('characters.store') }}" method="POST">
        @csrf
        <label for="name">Nome:</label>
        <input type="text" name="name" required>

        <label for="description">description:</label>
        <input type="text" name="description" required>

        <label for="strength">Strength:</label>
        <input type="number" name="strength" required>

        <label for="defense">Defense:</label>
        <input type="number" name="defense" required>

        <label for="speed">Speed:</label>
        <input type="number" name="speed" required>

        <label for="intelligence">intelligence:</label>
        <input type="number" name="intelligence" required>

        <label for="life">life:</label>
        <input type="number" name="life" required>

        <label for="speed">Speed:</label>
        <input type="number" name="speed" required>

        <button type="submit">Aggiungi Personaggio</button>
    </form>
</body>

</html>
