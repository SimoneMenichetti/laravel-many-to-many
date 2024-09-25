@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica Progetto</h1>



        <form action="{{ route('admin.projects.update', $project) }}" method="POST"
            onsubmit="return confirm('Sei sicuro di voler modificare questo progetto?');">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome Progetto</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $project->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Tipologia</label>
                <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
                    <option value="">Seleziona una tipologia</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="technology_{{ $technology->id }}"
                            name="technologies[]" value="{{ $technology->id }}"
                            {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
                        <!-- Se la tecnologia è già associata, segna il checkbox -->
                        <label class="form-check-label"
                            for="technology_{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                @endforeach

                @error('technologies')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Aggiorna Progetto</button>
        </form>
    </div>
@endsection
