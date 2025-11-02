<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pages\Gallery;
use Illuminate\Support\Arr;

class GalleryRequest extends FormRequest
{
    public function rules(): array
    {
        $galleryId = $this->route('gallery') ? $this->route('gallery')->id : null;
        $isUpdate = $galleryId !== null;

        $hasExistingImages = false;
        if ($isUpdate) {
            $gallery = Gallery::find($galleryId);
            $hasExistingImages = $gallery && $gallery->getMedia('images')->count() > 0;
        }

        $imagesRule = (!$isUpdate || !$hasExistingImages) ? 'required|array|min:1' : 'nullable|array';

        return [
            'title' => 'required|array',
            'title.en' => 'required_without_all:title.ckb|nullable|string|max:255',
            'title.ckb' => 'required_without_all:title.en|nullable|string|max:255',

            'description' => 'required|array',
            'description.en' => 'required_without_all:description.ckb|nullable|string',
            'description.ckb' => 'required_without_all:description.en|nullable|string',

            'branch_id' => 'required|exists:branches,id',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
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
            'gallery_category_id' => Arr::get($this->category_id, 'id', $this->category_id),
        ]);
    }

    public function attributes(): array
    {
        return [
            'title.en' => __('pages.title.en'),
            'description.en' => __('pages.content.en'),
            'title.ckb' => __('pages.title.ckb'),
            'description.ckb' => __('pages.content.ckb'),
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
