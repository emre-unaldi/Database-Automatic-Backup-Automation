<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DatabaseController;
use Illuminate\Http\Request;

class backupCommand extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup the database';

    public function handle()
    {
        $databases = DB::table('databases')->pluck('id')->toArray();
        $controller = new DatabaseController();

        foreach ($databases as $databaseId) {
            $request = new Request(['id' => $databaseId]);
            $controller->backupDatabaseById($request);
        }
        $this->info('Command Run Successfully');
        return Command::SUCCESS;
    }
}
