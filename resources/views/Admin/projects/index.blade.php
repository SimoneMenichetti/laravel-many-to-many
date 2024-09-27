@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Projects</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            Nuovo Progetto
        </a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipologia</th>
                    <th>Image</th>
                    <th>Tecnologie</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>
                            @if ($project->type)
                                <span class="badge bg-primary">{{ $project->type->name }}</span>
                            @else
                                <span class="badge bg-danger">N/A</span>
                            @endif
                        </td>

                        <td>
                            @if ($project->path_image)
                                <img src="{{ asset('storage/' . $project->path_image) }}"
                                    alt="{{ $project->image_original_name }}" class="image-thumbnail">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            {{-- inserisco i badge di bootstrap con una condizione se vuoto nessuna tech altrimenti iterando popola con le tech --}}
                            @if ($project->technologies->isEmpty())
                                <span class="badge bg-danger"><strong text-red>Nessuna technologia
                                        specificata</strong></span>
                            @else
                                @foreach ($project->technologies as $technology)
                                    <span class="badge bg-success"><strong
                                            text-white>{{ $technology->name }}</strong></span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-info">Visualizza</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Barra di paginazione -->
        <div class="d-flex justify-content-center mt-3">
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
