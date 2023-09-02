<?php

namespace App\Listeners;

use App\Events\ClassCanceled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClassCanceledMail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CanceledClassNotification;


class NotifyClassCanceled
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassCanceled $event): void
    {
        $scheduledClass = $event->scheduledClass;
        $members = $scheduledClass->members()->get();

        $className = $scheduledClass->classType->name;
        $classSchedule = $scheduledClass->date_time;
        $instructor = auth()->user()->name;

        $details = compact('className', 'classSchedule', 'instructor');

        Notification::send($members, new CanceledClassNotification($details));

        // $members->each(function($user) use ($details) {
        //     Mail::to($user)->send(new ClassCanceledMail($details));
        // });

        //Log::info($scheduledClass);
    }
}
