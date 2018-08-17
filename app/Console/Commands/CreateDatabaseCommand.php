<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new MySQL database.';

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
        $connectionName = config('database.default');
        $databaseName = config("database.connections.{$connectionName}.database");

        config(["database.connections.{$connectionName}.database" => null]);

        DB::statement("CREATE DATABASE IF NOT EXISTS " . $databaseName);

        config(["database.connections.{$connectionName}.database" => $databaseName]);
        DB::purge();
    }
}
