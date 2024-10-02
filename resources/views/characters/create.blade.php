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
        <label for="name">Character Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        <br><br>

        <button type="submit">Create Character</button>
    </form>

    <a href="{{ route('home') }}">Back to Character List</a>
</body>

</html>
