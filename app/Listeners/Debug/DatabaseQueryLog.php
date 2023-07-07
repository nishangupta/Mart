<?php

namespace App\Listeners\Debug;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class DatabaseQueryLog
{
    public function handle(QueryExecuted $event): void
    {
        Log::debug($event->sql, [
            'connection' => $event->connection->getName(),
            'bindings' => $event->bindings,
            'time' => $event->time,
        ]);
    }
}
