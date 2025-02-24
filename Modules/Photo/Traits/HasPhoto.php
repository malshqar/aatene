<?php

namespace Modules\Photo\Traits;

use Illuminate\Support\Facades\Storage;
use Modules\Photo\Entities\Photo;

trait HasPhoto
{


    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge($this->appends, ['assets']));

        return parent::getArrayableAppends();
    }


    protected function getArrayableItems(array $values)
    {
        if (!in_array('photo', $this->hidden)) {
            $this->hidden[] = 'photo';
        }
        return parent::getArrayableItems($values);
    }


    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function storeImage($src, $slug, $type = 'photo'): \Illuminate\Database\Eloquent\Model
    {
        return $this->photo()->create(['src' => $src, 'slug' => $slug, 'type' => $type]);
    }

    public function updateImage($src, $slug, $type = 'photo'): void
    {
        $this->deleteImage();
        $this->storeImage($src, $slug, $type);
    }

    public function deleteImage(): void
    {
        if ($this->photo()->count() >= 1) {
            foreach ($this->photo()->get() as $photo) {
                $photo->delete();
            }
        }
    }

    public function deleteImageByType($type): void
    {
        if ($this->photo()->count() >= 1) {
            foreach ($this->photo()->where('type', $type)->get() ?? [] as $photo) {
                $photo->delete();
            }
        }
    }

    public function getAssetsAttribute()
    {
        return $this->assets();
    }


    public static function uploadOnDisk($image, $dir = 'uploads', $disk = 'public')
    {
        $name = time() . '_' . rand(0, 5) . '_' . $image->getClientOriginalName();
        $path = $image->storeAs("$dir", $name, $disk);
        return $path;
    }

    public static function uploadImagesOnDisk($images, $dir = 'uploads', $disk = 'public')
    {
        $data_images = [];
        foreach ($images as $image) {
            $path = self::uploadOnDisk($images, $dir, $disk);
            $data_images[] = $path;
        }
        return $data_images;
    }

    public function assets()
    {
        $photo = $this->photo()->get();
        if (count($photo) <= 0) {
            return [
                'url' => 'https://placehold.co/100?text=No+Img',
                'type' => 'photo',
                'slug' => 'empty'
            ];
        } else if ((count($photo) == 1)) {
            //  $url = Storage::temporaryUrl($photo->src, now()->minutes(120));
            return [
                'url' => asset(Storage::url($this->photo->src)),
                'type' => $this->photo->type,
                'slug' => $this->photo->slug
            ];
        } else if ((count($photo) >= 2)) {
            $url = [];
            foreach ($photo as $el) {
                $url[] = [
                    'url' => asset(Storage::url($el->src)),
                    'type' => $el->type,
                    'slug' => $el->slug
                ];
            }
            return $url;
        }
    }
}
