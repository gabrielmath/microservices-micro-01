<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        /**
         * Parâmetro declarado na Rota "/categories/{category}"
         * A comparação está sendo feita pela URL porque ao invés de recebermos o ID de fato,
         * mudamos o parãmetro no controller pra receber a URL e realizar a busca por ela.
         * Logo, a exceção inserida na validação faz referência a URL e nao ao ID.
         */
        $url = $this->category;

        return [
            'title'       => ['required', 'min:3', 'max:150', "unique:categories,title,{$url},url"],
            'description' => ['required', 'min:3', 'max:255']
        ];
    }
}
