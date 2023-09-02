<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RemindMembersNotification;

class RemindMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind-members';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $members = User::where('role', 'member')->where('id', 4)->whereDoesntHave('bookings', function($query) {
            $query->where('date_time', '>', now());
        })->select('name', 'email')->get();

        Notification::send($members, new RemindMembersNotification);

        // $this->table(['Name', 'Email'], $members->toArray());
    }
}
