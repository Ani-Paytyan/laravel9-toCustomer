<?php

namespace App\Console\Commands;

use App\Models\AccessTokens;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AccessTokensCommand extends Command
{
    protected $signature = 'access:tokens';

    protected $description = 'Command for delete all old access tokens';

    public function handle()
    {
        $this->info('start delete all old access tokens...');
        AccessTokens::where('last_use_at','>=', Carbon::now()->subMonths(6)->toDateString())->delete();
        $this->info('finish deleted all old access tokens...');
    }
}
