<?php

namespace App\Observers;

use App\Models\IntroHowWork;
use File ;
class IntroHowWorkObserver
{
     /**
     * Handle the IntroHowWork "created" event.
     *
     * @param \App\IntroHowWork $IntroHowWork
     * @return void
     */
    public function creating(IntroHowWork $IntroHowWork)
    {
       
    }

    public function created(IntroHowWork $IntroHowWork)
    {

    }

    /**
     * Handle the IntroHowWork "updated" event.
     *
     * @param \App\IntroHowWork $IntroHowWork
     * @return void
     */

      public function updating (IntroHowWork $IntroHowWork)
    {
       if (request()->has('image')) {
             if ($IntroHowWork->getRawOriginal('image') != 'default.png'){
                File::delete(public_path('/storage/images/how_works/' . $IntroHowWork->getRawOriginal('image')));
             }
        }
    }
    public function updated(IntroHowWork $IntroHowWork)
    {

    }

    /**
     * Handle the IntroHowWork "deleted" event.
     *
     * @param \App\IntroHowWork $IntroHowWork
     * @return void
     */
    public function deleted(IntroHowWork $IntroHowWork)
    {
        if ($IntroHowWork->image != 'default.png'){
            File::delete(public_path('/storage/images/how_works/' . $IntroHowWork->getRawOriginal('image')));
        }
        
    }

    /**
     * Handle the IntroHowWork "restored" event.
     *
     * @param \App\IntroHowWork $IntroHowWork
     * @return void
     */
    public function restored(IntroHowWork $IntroHowWork)
    {
        //
    }

    /**
     * Handle the IntroHowWork "force deleted" event.
     *
     * @param \App\IntroHowWork $IntroHowWork
     * @return void
     */
    public function forceDeleted(IntroHowWork $IntroHowWork)
    {
        //
    }
}
