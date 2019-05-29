<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdicionarTipoRequest extends FormRequest
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
            "tipo" => "required|unique:tb_tipo_refrigerante"
        ];
    }

    public function messages() {
        return [
            "tipo.required" => "O campo tipo é obrigatório!",
            "tipo.unique" => "O nome da marca informada já existe!"
        ];
    }
}
