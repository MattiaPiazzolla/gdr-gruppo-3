@extends('layouts.app')

@section('content')
    <h1>TEST</h1>
    <div class="col-12 d-flex justify-content-end m-3">
        <a href="{{ route('characters.create') }}" class="btn btn-sm btn-primary">Aggiungi Personaggio</a>
    </div>
@endsection
