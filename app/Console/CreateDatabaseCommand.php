<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabaseCommand extends Command
{
    protected $signature = 'make:database';

    protected $description = 'Creates a new database.';

    public function __construct()
    {
        parent::__construct();

        //
    }

    public function handle()
    {
        DB::getConnection()->statement('CREATE DATABASE :schema', ['schema' => config('mysql.database')]);
    }
}
