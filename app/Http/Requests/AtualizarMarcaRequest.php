<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtualizarMarcaRequest extends FormRequest
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
            "nome" => "required|unique:tb_marca_refrigerante,id," . $this->input('id')
        ];
    }

    public function messages() {
        return [
            "nome.required" => "O campo nome é obrigatório!",
            "nome.unique" => "O nome da marca informada já existe!"
        ];
    }
}
