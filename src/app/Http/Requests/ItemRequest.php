<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required|max:255',
            'image' => 'required|mimes:jpeg,jpg,png',
            'category' => 'required|array|min:1',
            'category.*' => 'integer',
            'condition' => 'required',
            'price' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '商品説明は255文字以下で入力してください',
            'image.required' => '商品画像をアップロードしてください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'category.required' => '商品のカテゴリーを選択してください',
            'category.array' => 'カテゴリーを選択してください',
            'category.min' => '1つ以上のカテゴリーを選択してください',
            'category.*.integer' => 'カテゴリーの形式が不正です',
            'condition.required' => '商品の状態を入力してください',
            'price.required' => '商品価格を入力してください',
            'price.integer' => '商品価格は数値で入力してください',
            'price.min:0' => '金額は0円以上で入力してください',
        ];
    }
}
