<?php

namespace DominikStyp\LaravelArtisanCommandsWithPrompt\Console\Commands;

use Illuminate\Console\Command;
use function app_path;
use Symfony\Component\Console\Output\StreamOutput;


/**
 * Class CreateModel
 * @package DominikStyp\LaravelArtisanCommandsWithPrompt\Console\Commands
 *
 * Based on options of "make:model"
    -a, --all             Generate a migration, factory, and resource controller for the model
    -c, --controller      Create a new controller for the model
    -f, --factory         Create a new factory for the model
    --force           Create the class even if the model already exists.
    -m, --migration       Create a new migration file for the model.
    -p, --pivot           Indicates if the generated model should be a custom intermediate table model.
    -r, --resource        Indicates if the generated controller should be a resource controller.
    -h, --help            Display this help message
    -q, --quiet           Do not output any message
    -V, --version         Display this application version
    --ansi            Force ANSI output
    --no-ansi         Disable ANSI output
    -n, --no-interaction  Do not ask any interactive question
    --env[=ENV]       The environment the command should run under
    -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
 *
 */

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'with-prompt:make-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates model with all the possible options';

    protected $modelName = '';

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
        $args = [ 'name' => $this->getModelName() ];
        if($this->withAll()){
             $args['--all'] = true;
        } else {
                if($this->withMigration()){
                    $args['--migration'] = true;
                }
                if($this->withFactory()){
                    $args['--factory'] = true;
                }
                if($this->withController()){
                    $args['--controller'] = true;
                }
        }
        if($this->withSeeder()){
            \Artisan::call("make:seeder", [ 'name' => $this->getSeederName() ], $this->getOutput());
        }
        if($this->isPivot()){
            $args['--pivot'] = true;
        }
        \Artisan::call("make:model", $args, $this->getOutput());
        return;
    }

    protected function getModelName(){
        $ans = $this->ask("Your model name is:", "MyTestModel");
        $this->modelName = $ans;
        return $ans;
    }

    protected function getSeederName(){
        $default = str_ireplace("Model", "Seeder", $this->modelName);
        if(!stripos($default, "Seeder")){
            $default .= "Seeder";
        }
        $ans = $this->ask("Your seeder name is:", $default);
        return $ans;
    }

    protected function withAll(){
        $ans = $this->choice('Generate all at once (a migration, factory, and resource controller) for the model?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }


    protected function withMigration(){
        $ans = $this->choice('Generate migration for this model?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }

    protected function withFactory(){
        $ans = $this->choice('Generate factory for this model?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }

    protected function withController(){
        $ans = $this->choice('Generate controller for this model?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }

    protected function withSeeder(){
        $ans = $this->choice('Generate seeder class for this model?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }

    protected function isPivot(){
        $ans = $this->choice('Model should be a custom intermediate table model?', ['y', 'n'], 1, 5);
        return $ans === 'y';
    }


}
