<?php
namespace App\Providers;
use App\Models\General\Module;
use App\Models\General\Controller as ModelController;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);
        
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $resource = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
            $modulos = Module::with(['method', 'modules' => function($join){
                            $join->with('method')->orderBy('order');
                       }])->where('main',1)
                        ->orderBy('order')->get();     
                        
            foreach ($modulos as $modulo) {            
                if($modulo->modules->isNotEmpty()){
                    $submenu = [];
                    foreach ($modulo->modules as $module) {
                        try{
                            route($module->method->name);
                        }catch(\InvalidArgumentException $exeption){
                                $controladorFaltante = ModelController::query()->find($module->method->controller_id);
                                dd('Te hace falta una ruta para poder continuar, agregala en el archivo de rutas con el prefijo = '.$controladorFaltante->prefix);
                        }catch(\Exception $exception){
                            dd($exception->getMessage());
                        }        
                        if(Auth::user()->can($module->method->name)){
                            $submenu[] = [
                                'text' => $module->text,
                                'icon' => $module->icon,
                                'icon_color' => $module->icon_color,
                                'label' => $module->label,
                                'label_color' => $module->label_color,
                                'url' => route($module->method->name),
                            ];
                        }        
                    }
                }
                $items = [
                    'text' => $modulo->text,
                    'icon' => $modulo->icon,
                    'icon_color' => $modulo->icon_color,
                    'label' => $modulo->label,
                    'label_color' => $modulo->label_color,
                ];
                try{
                   is_null($modulo->method) ?  [] : $items['url'] = route($modulo->method->name);
                }catch(\InvalidArgumentException $exeption){
                    $controladorFaltante = ModelController::query()->find($modulo->method->controller_id);
                    dd('Te hace falta una ruta para poder continuar, agregala en el archivo de rutas con el prefijo = '.$controladorFaltante->prefix);                                        
                }catch(\Exception $exception){
                    dd($exception->getMessage());
                }
                

                (isset($submenu) && !empty($submenu)) ?  $items['submenu'] = $submenu : [];
                
                if(count($submenu)){
                    $event->menu->add($items);
                }else if(Auth::user()->can($module->method->name)){                    
                    $event->menu->add($items);
                }else if(!is_null($modulo->method) && Auth::user()->can($modulo->method->name)){
                    $event->menu->add($items);
                }
                $submenu = [];                    
            }
                               
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}