<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtualizarLitragemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nome" => "required|unique:tb_litragem_refrigerante,nome," . $this->input('id')
        ];
    }

    public function messages() {
        return [
            "nome.required" => "O campo nome é obrigatório!",
            "nome.unique" => "Litragem informada já existe!"
        ];
    }
}
