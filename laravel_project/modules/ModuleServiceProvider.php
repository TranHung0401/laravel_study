<?php
namespace Modules;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider {
    private $middlewares = [
    ];

    private $commands = [
    ];

    public function boot() {
        $modules = $this->getModules();
        if(!empty($modules)) {
            foreach($modules as $module){
                $this->registerModule($module);
            }
        }
    }

    public function register() {
        $modules = $this->getModules();
        if(!empty($modules)) {
            foreach($modules as $module){
                $this->registerConfig($module);
            }
        }

        //Middleware
        $this->registerMiddlewares();

        // Commands
        $this->commands($this->commands);

        $this->app->singleton(
            UserRepository::class
        );
    }

    //Get Module

    private function getModules() {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }

    //Register Module
    private function registerModule($module){
        $modulePath = __DIR__."/{$module}";

        // Khai bao routes
        if(FILE::exists($modulePath.'/routes/routes.php')){
            $this->loadRoutesFrom($modulePath.'/routes/routes.php');
        }

        //Khai bao migrations
        if(FILE::exists($modulePath.'/migrations')){
            $this->loadMigrationsFrom($modulePath.'/migrations');
        }

        //Khai bao languages
        if(FILE::exists($modulePath.'/resources/lang')){
            $this->loadTranslationsFrom($modulePath.'/resources/lang',strtolower($module));

            $this->loadJsonTranslationsFrom($modulePath.'/resources/lang');
        }

        // Khai bao view
        if(FILE::exists($modulePath.'/resources/views')){
            $this->loadViewsFrom($modulePath.'/resources/views',strtolower($module));
        }

        // Khai bao helpers
        if(FILE::exists($modulePath.'/helpers')){
            $helperList = File::allFiles($modulePath."/helpers");
            if(!empty($helperList)){
                foreach($helperList as $helper){
                    $file = $helper->getPathname();
                    require $file;
                }
            }
        }
    }

    // Register Config
    private function registerConfig($module) {
        $configPath = __DIR__.'/'.$module.'/configs';
        if(File::exists($configPath)){
            $configFiles = array_map('basename', File::allFiles($configPath));
            
            foreach($configFiles as $config){
                $alias = basename($config,'.php');
                $this->mergeConfigFrom($configPath.'/'.$config, $alias);
            }
        }
    }

    // Register middleware
    private function registerMiddlewares(){
        if(!empty($this->middlewares)){
            foreach($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }
}