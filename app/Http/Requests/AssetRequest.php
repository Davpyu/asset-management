<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
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
        $rules = [
            'kode_aset'     => ['required', 'string', 'unique:assets,code'],
            'nama_aset'     => ['required', 'string'],
            'jumlah'        => ['required', 'numeric'],
            'merk'          => ['required']
        ];
        switch ($this->method()) {
            case 'POST':
                return $rules;
            case 'PUT':
                foreach ($rules as $key => $values) {
                    $rules[$key] = ['sometimes', ...$values];
                }
                return $rules;
        }
    }
}
