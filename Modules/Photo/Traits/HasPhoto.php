<?php

namespace Modules\Photo\Traits;

use Illuminate\Support\Facades\Storage;
use Modules\Photo\Entities\Photo;

trait HasPhoto
{


    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge($this->appends, ['ImagesWithType', 'Images', 'Image']));

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

    public function getImageAttribute()
    {
        $photo = $this->photo;
        if (!$photo) {
            return 'https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        //  $url = Storage::temporaryUrl($photo->src, now()->minutes(120));
         $url = asset(Storage::url($photo->src));

        return $url;
    }



    public function getImagesAttribute()
    {
        $photo = $this->photo()->get();
        if (!$photo) {
            return 'https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        $url = [];
        foreach ($photo as $image) {
         $url[] = asset(Storage::url($image->src));

            // $url[] = Storage::disk('public')->temporaryUrl($image->src, now()->minutes(3600));
        }
        return $url;
    }

    public function getImagesWithTypeAttribute(): array|string
    {
        $photo = $this->photo()->get();
        if (!$photo) {
            return 'https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        $images = [];
        foreach ($photo as $image) {
            $images[] =
                [
                    'url' => Storage::disk('public')->temporaryUrl($image->src, now()->minutes(120)),
                    'type' => $image->type
                ];
        }
        return $images;
    }

    public static function uploadOnDisk($image, $dir = 'uploads', $disk = 'public')
    {
        $name =  time().'_'. $image->getClientOriginalName();
        $path = $image->storeAs("$dir", $name, $disk);
        return $path;
    }

    public static function uploadImagesOnDisk($images, $dir = 'uploads', $disk = 'public')
    {
        $data_images = [];
        foreach ($images as $image) {
            $name = rand() . time() . $image->getClientOriginalName();
            $path = $image->storeAs("$dir", $name, $disk);
            $data_images[] = $path;
        }
        return $data_images;
    }
}
