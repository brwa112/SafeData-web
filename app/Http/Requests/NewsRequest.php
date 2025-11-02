<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pages\News;
use Illuminate\Support\Arr;

class NewsRequest extends FormRequest
{
    public function rules(): array
    {
        $newsId = $this->route('news') ? $this->route('news')->id : null;
        $isUpdate = $newsId !== null;

        // For updates, check if the news has existing images
        $hasExistingImages = false;
        if ($isUpdate) {
            $news = News::find($newsId);
            $hasExistingImages = $news && $news->getMedia('images')->count() > 0;
        }

        // Images are required for:
        // 1. New records (create)
        // 2. Existing records that don't have images yet
        $imagesRule = (!$isUpdate || !$hasExistingImages) ? 'required|array|min:1' : 'nullable|array';

        return [
            'title' => 'required|array',
            'title.en' => 'required_without_all:title.ckb|nullable|string|max:255',
            'title.ckb' => 'required_without_all:title.en|nullable|string|max:255',

            'content' => 'required|array',
            'content.en' => 'required_without_all:content.ckb|nullable|string',
            'content.ckb' => 'required_without_all:content.en|nullable|string',

            'branch_id' => 'required|exists:branches,id',
            'news_category_id' => 'required|exists:news_categories,id',
            'hashtag_ids' => 'nullable|array',
            'hashtag_ids.*' => 'exists:hashtags,id',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',

            'images' => $imagesRule,
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'remove_images' => 'nullable|boolean',
            'deleted_image_ids' => 'nullable|array',
            'deleted_image_ids.*' => 'integer',

            'user_id' => 'required|exists:users,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'branch_id' => Arr::get($this->branch_id, 'id', $this->branch_id),
            'news_category_id' => Arr::get($this->category_id, 'id', $this->category_id),
        ]);
    }

    public function attributes(): array
    {
        return [
            'title.en' => __('pages.title.en'),
            'content.en' => __('pages.content.en'),
            'title.ckb' => __('pages.title.ckb'),
            'content.ckb' => __('pages.content.ckb'),
            'images' => __('pages.images'),
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => __('pages.images') . ' ' . __('validation.required'),
            'images.min' => __('pages.images') . ' must have at least one image.',
        ];
    }
}
