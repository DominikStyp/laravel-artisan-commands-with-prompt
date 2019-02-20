# Installation for local development

## composer.json
```
"repositories": [
        {
            "type": "path",
            "url": "packages-repos/dominikstyp/laravel-artisan-commands-with-prompt",
            "options": {
                "symlink": false
            }
        }
    ],
```

## Installation commands
```
composer require "dominikstyp/laravel-artisan-commands-with-prompt @dev" -vvv
php artisan vendor:publish --provider='\\DominikStyp\\LaravelArtisanCommandsWithPrompt\\LaravelArtisanCommandsWithPromptServiceProvider'
```