<?php

namespace Nova\Breadcrumbs;

use Illuminate\Support\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function boot ()
    {
        $breadcrumbs = new Classes\Breadcrumb();
        \View::share('__nova_breadcrumbs', $breadcrumbs);

        $this->registerBladeDirectives();
    }

    public function registerBladeDirectives ()
    {
        \Blade::directive('breadcrumbs', function ($expression) {
            return "<?php echo \$__nova_breadcrumbs; ?>";
        });

        \Blade::directive('pushBreadcrumb', function ($expression) {
            return "<?php \$__nova_breadcrumbs->push($expression) ?>";
        });
    }
}
