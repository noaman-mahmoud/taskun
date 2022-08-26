<?php

namespace App\Observers;

use File ;
use App\Models\Copy;

class CopyObserver
{
    public function created(Copy $row)
    {

    }

      public function updating (Copy $row)
    {
       if (request()->has('image')) {
             if ($row->getRawOriginal('image') != 'default.png'){
                File::delete(public_path('/storage/images/coyps/' . $row->getRawOriginal('image')));
             }
        }
    }

    /**
     * Handle the Copy "deleted" event.
     *
     * @param \App\Copy $row
     * @return void
     */
    public function deleted(Copy $row)
    {
        if ($row->getRawOriginal('image') != 'default.png'){
            File::delete(public_path('/storage/images/coyps/' . $row->getRawOriginal('image')));
        }
        
    }

}
