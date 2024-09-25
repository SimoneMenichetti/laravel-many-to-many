@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Crea Nuovo Progetto</h2>



        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf

            <!-- Campo per il nome del progetto -->
            <div class="mb-3">
                <label for="name" class="form-label">Nome Progetto</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo per la descrizione del progetto -->
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione Progetto</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="3" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo per la tipologia -->
            <div class="mb-3">
                <label for="type_id" class="form-label">Tipologia</label>
                <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror"
                    onchange="updateTypeDescription()">
                    <option value="">Seleziona una tipologia</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" data-description="{{ $type->description }}"
                            {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo per la descrizione della tipologia selezionata -->
            <div class="mb-3" id="type-description" style="display:none;">
                <label for="type_description" class="form-label">Descrizione Tipologia</label>
                <textarea class="form-control" id="type_description" rows="3" readonly></textarea>
            </div>

            <!-- Selezione delle tecnologie -->
            <div class="mb-3">
                <label for="technologies" class="form-label">Tecnologie</label>
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="technology_{{ $technology->id }}"
                            name="technologies[]" value="{{ $technology->id }}">
                        <label class="form-check-label"
                            for="technology_{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                @endforeach
                @error('technologies')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Crea Progetto</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>

    <script>
        function updateTypeDescription() {
            const selectElement = document.getElementById('type_id');
            const descriptionElement = document.getElementById('type-description');
            const typeDescriptionTextarea = document.getElementById('type_description');

            const selectedOption = selectElement.options[selectElement.selectedIndex];

            // Controlla se è stata selezionata una tipologia
            if (selectedOption.value) {
                const description = selectedOption.getAttribute('data-description');
                typeDescriptionTextarea.value = description;
                descriptionElement.style.display = 'block';
            } else {
                typeDescriptionTextarea.value = '';
                descriptionElement.style.display = 'none';
            }
        }
    </script>
@endsection
