<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Author;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StoreBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'isbn' => ['required'],
            'price' => ['required'],
            'category_id' => ['required'],
            'author' => ['required']
        ];
    }
    
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation() {
        $this->merge([
            'author_id' => Author::firstOrCreate(['name' => $this->author])->id
        ]);
    }
}
