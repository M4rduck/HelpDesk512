<?php

namespace App\Providers;

use App\Models\General\Module;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $modulos = Module::with(['method', 'modules' => function($join){
                            $join->with('method')->orderBy('order');
                       }])->where('main',1)
                        ->orderBy('order')->get();

            foreach ($modulos as $modulo) {
                if($modulo->modules->isNotEmpty()){
                    $submenu = [];
                    foreach ($modulo->modules as $module) {
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

                $items = [
                    'text' => $modulo->text,
                    'icon' => $modulo->icon,
                    'icon_color' => $modulo->icon_color,
                    'label' => $modulo->label,
                    'label_color' => $modulo->label_color,
                ];
                is_null($modulo->method) ?  [] : $items['url'] = route($modulo->method->name);

                (isset($submenu) && !empty($submenu)) ?  $items['submenu'] = $submenu : [];

                $submenu = [];

                $event->menu->add($items);
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
