<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character List</title>
</head>

<body>
    <h1>Character List</h1>

    @if ($characters->isEmpty())
        <p>No characters found!</p>
    @else
        <ul>
            @foreach ($characters as $character)
                <li>
                    <strong>{{ $character->name }}</strong> - {{ $character->description }}
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('characters.create') }}">Add New Character</a>
</body>

</html>
