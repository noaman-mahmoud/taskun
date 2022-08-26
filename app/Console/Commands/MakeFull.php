<?php

namespace app\Console\Commands;


use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class MakeFull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:fullSection {name=name} {arSingleName=arSingleName} {arpluraleName=arpluraleName} {--ob} {--seed} {--request} {--resource}';

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
        $arSingleName = $this->argument('arSingleName');
        $arpluraleName = $this->argument('arpluraleName');

        if ($this->confirm('sure you want to continue with name ' . $model , true)) {
            $folderNmae = strtolower(Str::plural(class_basename($model)));

            // #create model with mogration and model content
                Artisan::call('make:model',['name' => $model,'-m' => true]);
                File::copy('app/Models/Copy.php',base_path('app/Models/'.$model.'.php'));
                file_put_contents('app/Models/'.$model.'.php', preg_replace("/Copy/", $model, file_get_contents('app/Models/'.$model.'.php')));
                file_put_contents('app/Models/'.$model.'.php', preg_replace("/copys/", $folderNmae, file_get_contents('app/Models/'.$model.'.php')));
            // #create model with mogration and model content

            // create Controller
                Artisan::call('make:controller', ['name' => 'Admin/'.$model.'Controller']);
                File::copy('app/Http/Controllers/Admin/CopyController.php',base_path('app/Http/Controllers/Admin/'.$model.'Controller.php'));
                file_put_contents('app/Http/Controllers/Admin/'.$model.'Controller.php', preg_replace("/Copy/", $model, file_get_contents('app/Http/Controllers/Admin/'.$model.'Controller.php')));
                file_put_contents('app/Http/Controllers/Admin/'.$model.'Controller.php', preg_replace("/copys/", $folderNmae, file_get_contents('app/Http/Controllers/Admin/'.$model.'Controller.php')));
                file_put_contents('app/Http/Controllers/Admin/'.$model.'Controller.php', preg_replace("/arsinglesame/", $arSingleName , file_get_contents('app/Http/Controllers/Admin/'.$model.'Controller.php')));
                file_put_contents('app/Http/Controllers/Admin/'.$model.'Controller.php', preg_replace("/arpluraleName/", $arpluraleName , file_get_contents('app/Http/Controllers/Admin/'.$model.'Controller.php')));
            // #create Controller

            // // create folder and blade file
                // make directory folder
                File::makeDirectory('resources/views/admin/'.$folderNmae);
                // create index page //
                    File::copy('resources/views/admin/shared/copys/index.blade.php',base_path('resources/views/admin/'.$folderNmae.'/index.blade.php'));
                    file_put_contents(
                        'resources/views/admin/'.$folderNmae.'/index.blade.php'
                        , preg_replace(
                            "/copys/"
                            ,$folderNmae ,
                            file_get_contents('resources/views/admin/'.$folderNmae.'/index.blade.php')
                        )
                    );
                // # create index page //

                // create create form page //
                    File::copy('resources/views/admin/shared/copys/create.blade.php',base_path('resources/views/admin/'.$folderNmae.'/create.blade.php'));

                    file_put_contents(
                        'resources/views/admin/'.$folderNmae.'/create.blade.php'
                        , preg_replace(
                            "/copys/"
                            ,$folderNmae ,
                            file_get_contents('resources/views/admin/'.$folderNmae.'/create.blade.php')
                        )
                    );

                    file_put_contents(
                        'resources/views/admin/'.$folderNmae.'/create.blade.php'
                        , preg_replace(
                            "/نسخة/"
                            ,$arSingleName ,
                            file_get_contents('resources/views/admin/'.$folderNmae.'/create.blade.php')
                        )
                    );
                // #create create form page //

                // create edit form page //
                    File::copy('resources/views/admin/shared/copys/edit.blade.php',base_path('resources/views/admin/'.$folderNmae.'/edit.blade.php'));

                    file_put_contents(
                        'resources/views/admin/'.$folderNmae.'/edit.blade.php'
                        , preg_replace(
                            "/copys/"
                            ,$folderNmae ,
                            file_get_contents('resources/views/admin/'.$folderNmae.'/edit.blade.php')
                        )
                    );

                    file_put_contents(
                        'resources/views/admin/'.$folderNmae.'/edit.blade.php'
                        , preg_replace(
                            "/نسخة/"
                            ,$arSingleName ,
                            file_get_contents('resources/views/admin/'.$folderNmae.'/edit.blade.php')
                        )
                    );
                // create edit form page //

            // // #create folder and blade file


            // create web routes
                file_put_contents('routes/web.php',
                 preg_replace(
                     "/#new_routes_here/",
                     "
        /*------------ start Of ".$folderNmae." ----------*/
            Route::get('".$folderNmae."', [
                'uses'      => '".$model."Controller@index',
                'as'        => '".$folderNmae.".index',
                'title'     => '".$arpluraleName."',
                'icon'      => '<i class=\"feather icon-image\"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['".$folderNmae.".create', '".$folderNmae.".store','".$folderNmae.".edit', '".$folderNmae.".update', '".$folderNmae.".delete'  ,'".$folderNmae.".deleteAll' ,]
            ]);

            # ".$folderNmae." store
            Route::get('".$folderNmae."/create', [
                'uses'  => '".$model."Controller@create',
                'as'    => '".$folderNmae.".create',
                'title' => ' صفحة اضافة ".$arSingleName."'
            ]);


            # ".$folderNmae." store
            Route::post('".$folderNmae."/store', [
                'uses'  => '".$model."Controller@store',
                'as'    => '".$folderNmae.".store',
                'title' => ' اضافة ".$arSingleName."'
            ]);

            # ".$folderNmae." update
            Route::get('".$folderNmae."/{id}/edit', [
                'uses'  => '".$model."Controller@edit',
                'as'    => '".$folderNmae.".edit',
                'title' => 'صفحه تحديث ".$arSingleName."'
            ]);

            # ".$folderNmae." update
            Route::put('".$folderNmae."/{id}', [
                'uses'  => '".$model."Controller@update',
                'as'    => '".$folderNmae.".update',
                'title' => 'تحديث ".$arSingleName."'
            ]);

            # ".$folderNmae." delete
            Route::delete('".$folderNmae."/{id}', [
                'uses'  => '".$model."Controller@destroy',
                'as'    => '".$folderNmae.".delete',
                'title' => 'حذف ".$arSingleName."'
            ]);
            #delete all ".$folderNmae."
            Route::post('delete-all-".$folderNmae."', [
                'uses'  => '".$model."Controller@destroyAll',
                'as'    => '".$folderNmae.".deleteAll',
                'title' => 'حذف مجموعه من ".$arpluraleName."'
            ]);
        /*------------ end Of ".$folderNmae." ----------*/
        #new_routes_here
                     " ,
                     file_get_contents('routes/web.php')
                ));

                Artisan::call('route:clear');
            // #create web wroutes

            // create observer (optional)
                if ($this->option('ob')) {
                    Artisan::call('make:observer', ['name' => $model.'Observer']);
                    File::copy('app/Observers/CopyObserver.php',base_path('app/Observers/'.$model.'Observer.php'));
                    file_put_contents('app/Observers/'.$model.'Observer.php', preg_replace("/CopyObserver/", $model.'Observer', file_get_contents('app/Observers/'.$model.'Observer.php')));
                    file_put_contents('app/Observers/'.$model.'Observer.php', preg_replace("/Copy/", $model , file_get_contents('app/Observers/'.$model.'Observer.php')));
                    file_put_contents('app/Observers/'.$model.'Observer.php', preg_replace("/coyps/", $folderNmae , file_get_contents('app/Observers/'.$model.'Observer.php')));
                }
            // #create observer (optional)

            // create seeder (optional)
                if ($this->option('seed')) {
                    Artisan::call('make:seeder', ['name' => $model.'TableSeeder']);
                }
            // #create seeder (optional)

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
            $this->info('New Repository , Interface , Dashboard Controller , Model , DataBase Migrate , optional commands [ database seeder , admin section form request , observer] , Blade Folder And Blade File on dashboard , basic [index - store - update - delete] routes in web.php file for dashboard are created successfully ! ');
            // #call back
        }
    }
}
