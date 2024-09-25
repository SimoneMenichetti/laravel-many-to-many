@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $project->name }}</h1>
        <p><strong>Descrizione:</strong> {{ $project->description }}</p>
        <p><strong>Tipologia:</strong> {{ $project->type ? $project->type->name : 'N/A' }}</p>

        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Torna alla lista</a>

        <!-- Pulsante Modifica -->
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning">Modifica Progetto</a>

        <!-- Form per eliminare il progetto -->
        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Sei sicuro di voler eliminare questo progetto?');">Elimina Progetto</button>
        </form>
    </div>
@endsection
