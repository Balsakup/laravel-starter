<?php

namespace App\Providers;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Str;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $modulePath = rtrim(config('modules.path'), '/');
        $ignoredModules = config('modules.ignore');

        foreach (glob("$modulePath/*") as $moduleDir) {
            $moduleName = Str::lower(basename($moduleDir));

            if (in_array($moduleName, $ignoredModules, true)) {
                continue;
            }

            $migrationsPath = "$moduleDir/database/migrations";
            $viewsPath = "$moduleDir/resources/views";
            $routesPath = "$moduleDir/routes";
            $translationsPath = "$moduleDir/resources/lang";

            if (is_dir($modulePath)) {
                $this->loadMigrationsFrom($migrationsPath);
            }

            if (is_dir($viewsPath)) {
                $this->loadViewsFrom($viewsPath, $moduleName);
            }

            if (is_dir($routesPath)) {
                $this->loadRoutesFrom($routesPath);
            }

            if (is_dir($translationsPath)) {
                $this->loadTranslationsFrom($translationsPath, $moduleName);
                $this->loadJsonTranslationsFrom($translationsPath);
            }
        }
    }
}
