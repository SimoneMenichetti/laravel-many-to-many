<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type_id' => 'required|exists:types,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome del progetto è obbligatorio.',
            'description.required' => 'La descrizione del progetto è obbligatoria.',
            'type_id.required' => 'Selezionare una tipologia è obbligatorio.',
            'type_id.exists' => 'La tipologia selezionata non è valida.',
        ];
    }
}
