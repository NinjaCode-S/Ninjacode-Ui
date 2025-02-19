<?php

namespace Ninjacode\UI\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Ninjacode\UI\Components\NinjaUi;
use Ninjacode\UI\Components\ScopedSlot;
use Ninjacode\UI\Components\Tabs;
use Ninjacode\UI\Components\TabItem;

class NinjaCodeUIServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerLoads();
        $this->registerComponents();
        $this->registerDirectives();

        view()->share([
            'global_components_path' => dirname(__DIR__) . '/Resources/views/components/',
        ]);
    }

    protected function registerLoads()
    {
        $this->loadViewsFrom(dirname(__DIR__) . '/Resources/views', 'ui');
    }

    protected function registerComponents()
    {
        $this->loadViewComponentsAs(null , [
            UiNinjaUi::class,
            UiScopedSlot::class,
            UiTabs::class,
            UiTabItem::class,
        ]);
        Blade::anonymousComponentPath(dirname(__DIR__) . '/Resources/views/components');
    }

    protected function registerDirectives()
    {
        Blade::directive('scopedSlot', function ($expression) {
            // Разделение аргументов по `top-level` запятым (не в скобках)
            $directiveArguments = array_map('trim', preg_split("/,(?![^\(\(]*[\)\)])/", $expression));
            // Заполнение массива аргументов до 3 элементов
            $directiveArguments = array_pad($directiveArguments, 3, null);
            // Извлечение значений из массива аргументов
            [$name, $functionArguments, $functionUses] = $directiveArguments;
            // Подключение аргументов для формирования корректного объявления функции
            $functionArguments = $functionArguments ? "function {$functionArguments}" : '';
            // Обработка переменных use
            $functionUsesArray = array_filter(explode(',', trim($functionUses, '()')), 'strlen');
            array_push($functionUsesArray, '$__env');
            $functionUses = implode(',', $functionUsesArray);

            return "<?php \$__env->slot({$name}, {$functionArguments} use ({$functionUses}) { ?>";
        });


        Blade::directive('endScopedSlot', function () {
            return "<?php }); ?>";
        });
    }
}
