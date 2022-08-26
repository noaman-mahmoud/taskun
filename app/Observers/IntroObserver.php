<?php

namespace App\Observers;

use App\Models\Intro;
use File ;
class IntroObserver
{
    /**
    * Handle the Intro "created" event.
    *
    * @param \App\Intro $Intro
    * @return void
    */
   public function creating(Intro $Intro)
   {
      
   }

   public function created(Intro $Intro)
   {

   }

   /**
    * Handle the Intro "updated" event.
    *
    * @param \App\Intro $Intro
    * @return void
    */

     public function updating (Intro $Intro)
   {
      if (request()->has('image')) {
            if ($Intro->getRawOriginal('image') != '1.png' && $Intro->getRawOriginal('image') != '2.png'){
               File::delete(public_path('/storage/images/intros/' . $Intro->getRawOriginal('image')));
            }
       }
   }
   public function updated(Intro $Intro)
   {

   }

   /**
    * Handle the Intro "deleted" event.
    *
    * @param \App\Intro $Intro
    * @return void
    */
   public function deleted(Intro $Intro)
   {
       if ($Intro->getRawOriginal('image') != '1.png' && $Intro->getRawOriginal('image') != '2.png'){
           File::delete(public_path('/storage/images/intros/' . $Intro->getRawOriginal('image')));
       }
       
   }

   /**
    * Handle the Intro "restored" event.
    *
    * @param \App\Intro $Intro
    * @return void
    */
   public function restored(Intro $Intro)
   {
       //
   }

   /**
    * Handle the Intro "force deleted" event.
    *
    * @param \App\Intro $Intro
    * @return void
    */
   public function forceDeleted(Intro $Intro)
   {
       //
   }
}
