<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class VipActivate extends Command
{
    protected $signature = 'app:vip:activate {emails*}';

    protected $description = 'Activate VIP permission';

    public function handle(User $userModel): int
    {
        $userModel->newQuery()
            ->select('email')
            ->whereIn('email', $this->argument('emails'))
            ->get()
            ->each(function (User $user) {
                $user->features()->activate('vip');
            });

        return self::SUCCESS;
    }
}
