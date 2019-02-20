# Laravel Artisan Commands With Prompt
Makes **AbstractModel** inside app/models directory, changes **make:model** command,to generate models which inherit from **AbstractModel**,
and provides php artisan command to move your existing models to app/models directory and change their inheritance to **AbstractModel**.
Thanks to that all your models will inherit from your custom class.<br />

# Installation
```
composer require "dominikstyp/laravel-artisan-commands-with-prompt @dev" -vvv
php artisan vendor:publish --provider='\\DominikStyp\\LaravelModelAbstractor\\LaravelModelAbstractorServiceProvider'
```

## Laravel >= 5.5
Due to package discovery feature introduced in Laravel 5.5, you don't have to add service provider to your providers any more.<br />
## Laravel < 5.5
For Laravel less than 5.5, you must add service provider to your **config/app.php** file, as follows: <br />
```php
 'providers' => [
    // ...
    DominikStyp\LaravelArtisanCommandsWithPrompt\LaravelArtisanCommandsWithPromptServiceProvider::class,
    // ...
  ],
```

# Usage
**Laravel Artisan Commands With Prompt** provides new console tasks: <br />
``` with-prompt:make-model ``` Which guides you through original ``` make:model ``` command, asking you series of questions about possible options <br />
For example:
- Your model name ?
- Generate all at once (a migration, factory, and resource controller) for the model?
- Generate migration for this model?
- Generate factory for this model?
- Generate controller for this model?
- Generate seeder class for this model?
- Model should be a custom intermediate table model?
After answering mainly "y" or "n" (Yes/No) it will generate what you need.<br />
You don't need a documentation peek before generating model again.