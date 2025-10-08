<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCourseRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'title' => 'required|string|max:255',
			'description' => 'required|string',
			'level' => 'required|integer|in:1,2,3',
			'price' => 'nullable|numeric|min:0',
			'image' => 'nullable|image|max:2048',
			'public' => 'nullable|boolean',
			'sections' => 'required|array|min:1',
			'sections.*.title' => 'required|string|max:255',
		];
	}

	public function messages(): array
	{
		return [
			'sections.*.title.required' => 'Section title is required.',
		];
	}
}
