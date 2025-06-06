<?php

namespace Ninjacode\UI\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Ninjacode\UI\Components\UiNinjaUi;
use Ninjacode\UI\Components\ScopedSlot;
use Ninjacode\UI\Components\UiTabs;
use Ninjacode\UI\Components\UiTabItem;

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
        $components = [
            UiNinjaUi::class,
            ScopedSlot::class,
            UiTabs::class,
            UiTabItem::class,
        ];

        $this->loadViewComponentsAs('x', $components);
        $this->loadViewComponentsAs('', $components);

        Blade::anonymousComponentPath(dirname(__DIR__) . '/Resources/views/components');
        $this->registerAnonymousComponentsWithoutPrefix();
    }

    protected function registerAnonymousComponentsWithoutPrefix()
    {
        $componentPath = dirname(__DIR__) . '/Resources/views/components';

        if (is_dir($componentPath)) {
            $files = glob($componentPath . '/*.blade.php');

            foreach ($files as $file) {
                $componentName = basename($file, '.blade.php');

                // Регистрируем компонент без префикса
                Blade::component($componentName, 'ui::components.' . $componentName);
            }
        }
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
