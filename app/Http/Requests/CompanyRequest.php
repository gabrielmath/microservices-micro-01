<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
         * Parâmetro declarado na Rota "/companies/{company}"
         * A comparação está sendo feita pelo UUID porque ao invés de recebermos o ID de fato,
         * mudamos o parãmetro no controller pra receber o UUID e realizar a busca por ele.
         * Logo, a exceção inserida na validação faz referência ao UUID e nao ao ID.
         */
        $uuid = $this->company;

        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name'        => ['required', "unique:companies,name,{$uuid},uuid"],
            'whatsapp'    => ['required', "unique:companies,whatsapp,{$uuid},uuid"],
            'email'       => ['required', 'email', "unique:companies,email,{$uuid},uuid"],
            'phone'       => ['nullable', "unique:companies,phone,{$uuid},uuid"],
            'facebook'    => ['nullable', "unique:companies,facebook,{$uuid},uuid"],
            'instagram'   => ['nullable', "unique:companies,instagram,{$uuid},uuid"],
            'youtube'     => ['nullable', "unique:companies,youtube,{$uuid},uuid"],
        ];
    }
}
