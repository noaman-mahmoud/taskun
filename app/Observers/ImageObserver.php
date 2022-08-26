<?php

namespace App\Observers;

use File ;
use App\Models\Image;

class ImageObserver
{
    public function created(Image $row)
    {

    }

      public function updating (Image $row)
    {
       if (request()->has('image')) {
             if ($row->getRawOriginal('image') != '1.png' && $row->getRawOriginal('image') != '2.png' && $row->getRawOriginal('image') != '3.png' && $row->getRawOriginal('image') != '4.png'){
                File::delete(public_path('/storage/images/images/' . $row->getRawOriginal('image')));
             }
        }
    }

    /**
     * Handle the Image "deleted" event.
     *
     * @param \App\Image $row
     * @return void
     */
    public function deleted(Image $row)
    {
        if ($row->getRawOriginal('image') != '1.png' && $row->getRawOriginal('image') != '2.png' && $row->getRawOriginal('image') != '3.png' && $row->getRawOriginal('image') != '4.png'){
            File::delete(public_path('/storage/images/images/' . $row->getRawOriginal('image')));
        }
        
    }

}
