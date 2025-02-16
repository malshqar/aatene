<?php

namespace Modules\Photo\Observers;

use Modules\Photo\Entities\Photo;

class PhotoObserver
{
    public function deleting(Photo $photo): void
    {
        $is_exist = Photo::where('src', $photo->src)->exists();
        if ($is_exist) {
            \Storage::disk('public')->delete($photo->src);
        }
    }

}
