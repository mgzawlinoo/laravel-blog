<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|min:4',
            'slug' => 'string|unique:posts,slug,' . $this->post->id,
            'content' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'ခေါင်းစဥ် ထည့်ပါ',
            'title.min' => 'စာလုံး အရေအတွက် အနည်းဆုံး လေးလုံး ရှိရမည်',
            'title.max' => 'စာလုံး အရေအတွက် အများဆုံး ၂၅၅ လုံးသာ ရှိရမည်',
            'slug.unique' => 'အဆိုပါ အမည်ဖြင့် post ရှိနှင့်ပြီး ဖြစ်သည်',
            'content.required' => 'စာကိုယ် ထည့်ပါ',
            'category_id.required' => 'အမျိုးအစား ရွေးချယ်ပါ',
            'user_id.required' => 'စာရေးသူ ရွေးချယ်ပါ',
            'photo.image' => 'ဓာတ်ပုံ မဟုတ်ပါ',
            'photo.mimes' => 'ဓာတ်ပုံ အမျိုးအစား အဖြစ် png, jpg, jpeg ကို သာလက်ခံပါတယ်',
            'photo.max' => 'ဓာတ်ပုံ အများဆုံး 2mb သာ ရှိရမည်',
        ];
    }
}
