<?php

namespace App\Services;

use Image;

class ImageService
{
    public function updateImage($model, $request)
    {
        $image = Image::make($request->file('image'));

        if (!empty($model->image)) {
            $currentImage = public_path() . $model->image;

            if (file_exists($currentImage) && $currentImage != public_path() . '/img/avatar.png') {
                unlink($currentImage);
            }
        }

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        if ($request->width) {
            $image->crop(
                $request->width,
                $request->height,
                $request->left,
                $request->top
            );
        }

        $name = time() . '.' . $extension;
        $image->save(public_path() . '/img/' . $name);
        $model->image = '/img/' .$name;

        return $model;
    }
}
