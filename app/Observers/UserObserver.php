<?php

namespace App\Observers;

use File ;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function created(User $user)
    {
       
    }


    /**
     * Handle the user "updated" event.
     *
     * @param \App\User $user
     * @return void
     */

      public function updating (User $user)
    {
       if (request()->has('avatar')) {
             if ($user->getRawOriginal('avatar') != 'default.png'){
                File::delete(public_path('/storage/images/users/' . $user->getRawOriginal('avatar')));
             }
        }
    }
    public function updated(User $user)
    {

    }

    /**
     * Handle the user "deleted" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        if ($user->getRawOriginal('avatar') != 'default.png'){
            File::delete(public_path('/storage/images/users/' . $user->getRawOriginal('avatar')));
        }
        
    }

    /**
     * Handle the user "restored" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
