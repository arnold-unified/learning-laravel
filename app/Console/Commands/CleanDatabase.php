<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class CleanDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clean {--tables=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean database';

    protected $tables = [
        'permission_role',
        'permissions',
        'role_user',
        'roles',
        'profiles',
        'users',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $optTables = $this->option('tables');

        if (env('APP_ENV') !== 'local') {
            $this->line('Cannot clean database in production.');
            exit;
        }

        $tables = $this->getTables($optTables);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->line('Database successfully cleaned.');
    }

    private function getTables($optTables)
    {
        $tables = [];

        if ($optTables != '') {
            $explodedTables = collect(explode(',', $optTables))
                ->map(function ($t) {
                    return preg_replace('/\s+/', '', $t); 
                })
                ->filter()
                ->all();

            $tables = $this->trimTables($explodedTables);
        } else {
            $tables = $this->tables;
        }

        return $tables;
    }

    private function trimTables($explodedTables)
    {
        $dbTables = [];
        $filteredTables = [];
        $dbName = 'Tables_in_' . env('DB_DATABASE');
        
        foreach (DB::select('SHOW TABLES') as $table) {
            $dbTables[] = $table->$dbName;
        }

        $filteredTables = collect($explodedTables)->filter(function ($tbl) use ($dbTables) {
            return in_array($tbl, $dbTables);
        });

        return $filteredTables->all();
    }
}
