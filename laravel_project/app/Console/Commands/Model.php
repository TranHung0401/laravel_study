<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use File;

class Model extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make module CLI';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        if(File::exists(base_path('modules/'.$name))){
            $this->error('Module already exists!');
        }else {
            File::makeDirectory(base_path('modules/'.$name), 0755, true, true);

            // config
            $configFolder = base_path('modules/'.$name.'/configs');

            if(!File::exists($configFolder)){
                File::makeDirectory($configFolder, 0755, true, true);
            }

            // helpers
            $helpsFolder = base_path('modules/'.$name.'/helpers');

            if(!File::exists($helpsFolder)){
                File::makeDirectory($helpsFolder, 0755, true, true);
            }

            // migrations
            $migrationsFolder = base_path('modules/'.$name.'/migrations');

            if(!File::exists($migrationsFolder)){
                File::makeDirectory($migrationsFolder, 0755, true, true);
            }

            // resources
            $resourcesFolder = base_path('modules/'.$name.'/resources');

            if(!File::exists($resourcesFolder)){
                File::makeDirectory($resourcesFolder, 0755, true, true);

                // lang
                $langFolder = base_path('modules/'.$name.'/resources/lang');

                if(!File::exists($langFolder)){
                    File::makeDirectory($langFolder, 0755, true, true);
                }

                // views
                $viewsFolder = base_path('modules/'.$name.'/resources/views');

                if(!File::exists($viewsFolder)){
                    File::makeDirectory($viewsFolder, 0755, true, true);
                }

            }

            // routes
            $routesFolder = base_path('modules/'.$name.'/routes');

            if(!File::exists($routesFolder)){
                File::makeDirectory($routesFolder, 0755, true, true);

                // file
                $pathFile = base_path('modules/'.$name.'/routes/routes.php');

                if(!File::exists($pathFile)){
                    File::put($pathFile, "<?php \n use Illuminate\Support\Facades\Route;");
                }
            }

            // src
            $srcFolder = base_path('modules/'.$name.'/src');

            if(!File::exists($srcFolder)){
                File::makeDirectory($srcFolder, 0755, true, true);

                $commandsFolder = base_path('modules/'.$name.'/src/Commands');

                if(!File::exists($commandsFolder)){
                    File::makeDirectory($commandsFolder, 0755, true, true);
                }
                
                // http
                $httpFolder = base_path('modules/'.$name.'/src/Http');

                if(!File::exists($httpFolder)){
                    File::makeDirectory($httpFolder, 0755, true, true);

                    // controllers
                    $controllersFolder = base_path('modules/'.$name.'/src/Http/Controllers');

                    if(!File::exists($controllersFolder)){
                        File::makeDirectory($controllersFolder, 0755, true, true);
                    }

                    // middlewares
                    $middlewaresFolder = base_path('modules/'.$name.'/src/Http/Middlewares');

                    if(!File::exists($middlewaresFolder)){
                        File::makeDirectory($middlewaresFolder, 0755, true, true);
                    }
                }

                // model
                $modelFolder = base_path('modules/'.$name.'/src/Models');
                if(!File::exists($modelFolder)){
                    File::makeDirectory($modelFolder, 0755, true, true);
                }

                // repositories
                $repositoryFolder = base_path('modules/'.$name.'/src/Repositories');
                if(!File::exists($repositoryFolder)){
                    File::makeDirectory($repositoryFolder, 0755, true, true);

                    // Module repository
                    $moduleRepositoryFile = base_path('modules/'.$name.'/src/Repositories/'.$name.'Repository.php');
                    if(!File::exists($moduleRepositoryFile)) {

                        $moduleRepositoryFileContent = file_get_contents(app_path('Console/Commands/Templates/ModuleRepository.txt'));

                        $moduleRepositoryFileContent = str_replace('{module}',$name,$moduleRepositoryFileContent);

                        File::put($moduleRepositoryFile, $moduleRepositoryFileContent);
                    }

                    // Module repository interface
                    $moduleRepositoryInterfaceFile = base_path('modules/'.$name.'/src/Repositories/'.$name.'RepositoryInterface.php');
                    if(!File::exists($moduleRepositoryInterfaceFile)) {

                        $moduleRepositoryInterfaceFileContent = file_get_contents(app_path('Console/Commands/Templates/ModuleRepositoryInterface.txt'));

                        $moduleRepositoryInterfaceFileContent = str_replace('{module}',$name,$moduleRepositoryInterfaceFileContent);

                        File::put($moduleRepositoryInterfaceFile, $moduleRepositoryInterfaceFileContent);
                    }
                }

            }

            $this->info('Module created successfully!');
        }
    }
}
