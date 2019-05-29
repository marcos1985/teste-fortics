<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdicionarRefrigeranteRequest extends FormRequest
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
            "nome" => "required",
            "sabor" => "required",
            "id_tipo_refrigerante" => "required",
            "id_litragem" => 'required',
            "qtd_estoque" => 'required',
            "valor_unidade" => 'required'
        ];
    }

    public function messages() {
        return [
            "nome.required" => "O campo Marca é obrigatório!",
            "sabor.required" => "O campo Sabor é obrigatório!",
            "id_tipo_refrigerante.required" => "O campo Tipo é obrigatório!",
            "id_litragem.required" => "O campo Litragem é obrigatório!",
            "qtd_estoque.required" => "O campo Quantidade é obrigatório!",
            "valor_unidade.required" => "O campo Valor é obrigatório!",
        ];
    }
}
