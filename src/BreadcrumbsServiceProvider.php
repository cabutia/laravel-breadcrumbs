<?php

namespace Nova\Breadcrumbs;

use Illuminate\Support\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function boot ()
    {
        dump('Breadcrumbs!');
    }

    public function register ()
    {

    }
}
