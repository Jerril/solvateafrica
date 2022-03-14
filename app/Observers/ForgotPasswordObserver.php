<?php

namespace App\Observers;

use App\Models\ForgotPassword;
use App\Notifications\ForgotPasswordNotification;

class ForgotPasswordObserver
{
    /**
     * Handle the ForgotPassword "created" event.
     *
     * @param  \App\Models\ForgotPassword  $forgotPassword
     * @return void
     */
    public function created(ForgotPassword $forgotPassword)
    {
        $data['name'] = $forgotPassword->user->name;
        $data['code'] = $forgotPassword->code;
        Notification::send($forgotPassword->user, new ForgotPasswordNotification($data));
    }

    /**
     * Handle the ForgotPassword "updated" event.
     *
     * @param  \App\Models\ForgotPassword  $forgotPassword
     * @return void
     */
    public function updated(ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Handle the ForgotPassword "deleted" event.
     *
     * @param  \App\Models\ForgotPassword  $forgotPassword
     * @return void
     */
    public function deleted(ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Handle the ForgotPassword "restored" event.
     *
     * @param  \App\Models\ForgotPassword  $forgotPassword
     * @return void
     */
    public function restored(ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Handle the ForgotPassword "force deleted" event.
     *
     * @param  \App\Models\ForgotPassword  $forgotPassword
     * @return void
     */
    public function forceDeleted(ForgotPassword $forgotPassword)
    {
        //
    }
}
