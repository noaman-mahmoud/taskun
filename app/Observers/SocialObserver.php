<?php

namespace App\Observers;
use File ; 
use App\Models\Social;

class SocialObserver
{
    
    /**
    * Handle the Social "created" event.
    *
    * @param \App\Social $Social
    * @return void
    */
   public function creating(Social $Social)
   {
      
   }

   public function created(Social $Social)
   {

   }

   /**
    * Handle the Social "updated" event.
    *
    * @param \App\Social $Social
    * @return void
    */

     public function updating (Social $Social)
   {
      if (request()->has('icon')) {
            if ($Social->getRawOriginal('icon') != 'facebook.png' && $Social->getRawOriginal('icon') != 'twitter.png' && $Social->getRawOriginal('icon') != 'Instagram.png'){
               File::delete(public_path('/storage/images/socials/' . $Social->getRawOriginal('icon')));
            }
       }
   }
   public function updated(Social $Social)
   {

   }

   /**
    * Handle the Social "deleted" event.
    *
    * @param \App\Social $Social
    * @return void
    */
   public function deleted(Social $Social)
   {
       if ($Social->getRawOriginal('icon') != 'facebook.png' && $Social->getRawOriginal('icon') != 'twitter.png' && $Social->getRawOriginal('icon') != 'Instagram.png'){
           File::delete(public_path('/storage/images/socials/' . $Social->getRawOriginal('icon')));
       }
       
   }

   /**
    * Handle the Social "restored" event.
    *
    * @param \App\Social $Social
    * @return void
    */
   public function restored(Social $Social)
   {
       //
   }

   /**
    * Handle the Social "force deleted" event.
    *
    * @param \App\Social $Social
    * @return void
    */
   public function forceDeleted(Social $Social)
   {
       //
   }
}
