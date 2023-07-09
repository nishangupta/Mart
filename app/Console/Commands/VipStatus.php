<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class VipStatus extends Command
{
    protected $signature = 'app:vip:status {emails*}';

    protected $description = 'Inspect VIP status';

    public function handle(User $userModel): int
    {
        $status = $userModel->newQuery()
            ->select('email')
            ->whereIn('email', $this->argument('emails'))
            ->get()
            ->map(function (User $user) {
                $user['vip'] = $user->features()->active('vip') ? 'ON' : 'OFF';

                return $user->toArray();
            });

        $this->table(['Email', 'status'], $status->toArray());

        return self::SUCCESS;
    }
}
