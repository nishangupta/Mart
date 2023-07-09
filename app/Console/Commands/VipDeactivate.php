<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class VipDeactivate extends Command
{
    protected $signature = 'app:vip:deactivate {emails*}';

    protected $description = 'Deactivate VIP permission';

    public function handle(User $userModel): int
    {
        $userModel->newQuery()
            ->select('email')
            ->whereIn('email', $this->argument('emails'))
            ->get()
            ->each(function (User $user) {
                $user->features()->deactivate('vip');
            });

        return self::SUCCESS;
    }
}
