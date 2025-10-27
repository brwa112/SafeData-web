<?php

namespace App\Http\Requests\System\Settings\Pages\Home;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeroRequest extends FormRequest
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
            'title' => 'required|array',
            'title.en' => 'required|string|max:255',
            'title.ckb' => 'required|string|max:255',
            'subtitle' => 'required|array',
            'subtitle.en' => 'required|string|max:255',
            'subtitle.ckb' => 'required|string|max:255',
            'metadata' => 'required|array',
            'metadata.expert_tutors' => 'required|integer|min:0',
            'metadata.students' => 'required|integer|min:0',
            'metadata.experience' => 'required|integer|min:0',
            'metadata.campuses' => 'required|integer|min:0',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'background_video' => 'nullable|mimes:mp4,webm|max:51200',
            'is_active' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title.en' => __('system.hero_title') . ' (' . __('system.en') . ')',
            'title.ckb' => __('system.hero_title') . ' (' . __('system.ckb') . ')',
            'title.ar' => __('system.hero_title') . ' (' . __('system.ar') . ')',
            'subtitle.en' => __('system.hero_subtitle') . ' (' . __('system.en') . ')',
            'subtitle.ckb' => __('system.hero_subtitle') . ' (' . __('system.ckb') . ')',
            'subtitle.ar' => __('system.hero_subtitle') . ' (' . __('system.ar') . ')',
            'metadata.expert_tutors' => __('system.expert_tutors'),
            'metadata.students' => __('system.students'),
            'metadata.experience' => __('system.years_experience'),
            'metadata.campuses' => __('system.campuses'),
            'background_image' => __('system.background_image'),
            'background_video' => __('system.video'),
        ];
    }
}
