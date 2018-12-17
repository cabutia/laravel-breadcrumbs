<?php

namespace Nova\Breadcrumbs;

use Illuminate\Support\ServiceProvider;

class BredcrumbsServiceProvider extends ServiceProvider
{
    public function boot ()
    {
        dump('Breadcrumbs!');
    }

    public function register ()
    {

    }
}
