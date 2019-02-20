<?php

namespace DominikStyp\LaravelArtisanCommandsWithPrompt\Console\Commands;

use Illuminate\Console\Command;


/**
 * Class CreateModel
 * @package DominikStyp\LaravelArtisanCommandsWithPrompt\Console\Commands
 * Options:
    --database[=DATABASE]  The database connection to use.
    --force                Force the operation to run when in production.
    --path[=PATH]          The path of migrations files to be executed.
    --pretend              Dump the SQL queries that would be run.
    --seed                 Indicates if the seed task should be re-run.
    --step                 Force the migrations to be run so they can be rolled back individually.
    -h, --help                 Display this help message
    -q, --quiet                Do not output any message
    -V, --version              Display this application version
    --ansi                 Force ANSI output
    --no-ansi              Disable ANSI output
    -n, --no-interaction       Do not ask any interactive question
    --env[=ENV]            The environment the command should run under
    -v|vv|vvv, --verbose       Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

 *
 */

class Migrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'with-prompt:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invokes migrate command';


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
        $args = [];
        if($this->withPretend()){
            $args['--pretend'] = true;
        }
        if($this->withPretend()){
            $args['--seed'] = true;
        }
        if($this->withStep()){
            $args['--step'] = true;
        }
        if($this->withForce()){
            $args['--force'] = true;
        }
        if($this->isDifferentMigrationsFolderPath()){
            $args['--path'] = $this->getAlternativePath();
        }
        \Artisan::call("migrate", $args, $this->getOutput());
        return;
    }


    protected function withPretend(){
        $ans = $this->choice('Dump the SQL queries that would be run ?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }

    protected function withSeed(){
        $ans = $this->choice('Do re-run seed task ?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }

    protected function withStep(){
        $ans = $this->choice('Force the migrations to be run so they can be rolled back individually ?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }
    protected function withForce(){
        $ans = $this->choice('Force the operation to run when in production ?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }

    protected function isDifferentMigrationsFolderPath(){
        $ans = $this->choice('Do you have different path of migrations folder ?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }

    protected function getAlternativePath(){
        $ans = $this->ask('What is folder path ?',null);
        return $ans;
    }



}
