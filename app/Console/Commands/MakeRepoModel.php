<?php

namespace App\Console\Commands;

use File ;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeRepoModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:semisection {name=name} {--ob} {--seed} {--resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $model = $this->argument('name');
        if ($this->confirm('sure you want to continue with name ' . $model , true)) {
            $folderNmae = strtolower(Str::plural(class_basename($model)));
            
            // #create model with mogration and model content 
                Artisan::call('make:model',['name' => $model,'-m' => true]);
                File::copy('app/Models/copy.php',base_path('app/Models/'.$model.'.php'));
                file_put_contents('app/Models/'.$model.'.php', preg_replace("/Copy/", $model, file_get_contents('app/Models/'.$model.'.php')));
                file_put_contents('app/Models/'.$model.'.php', preg_replace("/copys/", $folderNmae, file_get_contents('app/Models/'.$model.'.php')));
            // #create model with mogration and model content

            

            // create observer (optional) 
            if ($this->option('ob')) {
                Artisan::call('make:observer', ['name' => $model.'Observer']);
                File::copy('app/Observers/CopyObserver.php',base_path('app/Observers/'.$model.'Observer.php'));
                file_put_contents('app/Observers/'.$model.'Observer.php', preg_replace("/CopyObserver/", $model.'Observer', file_get_contents('app/Observers/'.$model.'Observer.php')));
                file_put_contents('app/Observers/'.$model.'Observer.php', preg_replace("/Copy/", $model , file_get_contents('app/Observers/'.$model.'Observer.php')));
                file_put_contents('app/Observers/'.$model.'Observer.php', preg_replace("/coyps/", $folderNmae , file_get_contents('app/Observers/'.$model.'Observer.php')));
            }
        // #create observer (optional) 
        
        // create request (optional) 
            if ($this->option('request')) {
                Artisan::call('make:request', ['name' => 'Admin/' . $folderNmae .'/Store']);
                File::copy('app/Http/Requests/Admin/copy.php',base_path('app/Http/Requests/Admin/' . $folderNmae .'/Store.php'));
                file_put_contents('app/Http/Requests/Admin/' . $folderNmae .'/Store.php', preg_replace("/Copy/", $folderNmae , file_get_contents('app/Http/Requests/Admin/' . $folderNmae .'/Store.php')));
            }
        // #create request (optional) 
        
        // create request (optional) 
            if ($this->option('resource')) {
                Artisan::call('make:resource', ['name' => 'Api/' . $model .'Resource']);
            }
        // #create request (optional) 

            // call back  
            $this->info('New Repository , Interface , Model , DataBase Migrate , optional commands [ database seeder , resource , observer]  are created successfully ! ');
            // #call back
        }
    }
}
