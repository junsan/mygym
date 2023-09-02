<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ScheduledClass;

class ScheduledClassPolicy
{
    public function delete(User $user, ScheduledClass $scheduledclass) {
        return $user->id === $scheduledclass->instructor_id && $scheduledclass->date_time > now()->addHours(2);
    }
}
